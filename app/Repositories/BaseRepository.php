<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Schema;

class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function search(array $filters)
    {
        $query = $this->model->query(); // Inicia la consulta en el modelo correspondiente

        // Verificar si se proporcionan columnas específicas para seleccionar
        if (isset($filters['select'])) {
            $query->select($filters['select']); // Seleccionar las columnas necesarias
        }

        // Procesar joins (si aplica)
        if (isset($filters['join'])) {
            foreach ($filters['join'] as $join) {
                $joinType = $join['type'] ?? 'leftJoin'; // Por defecto es LEFT JOIN
                $query->$joinType(
                    $join['table'] . ' as ' . $join['alias'], // Alias de la tabla
                    $join['foreign_key'],
                    '=',
                    $join['local_key']
                );
            }
        }

        // Procesar condiciones OR
        if (isset($filters['or'])) {
            $query->where(function ($subQuery) use ($filters) {
                foreach ($filters['or'] as $orCondition) {
                    $subQuery->orWhere(
                        $orCondition['field'],
                        $orCondition['operator'] ?? '=',
                        $orCondition['value']
                    );
                }
            });
        }

        // Procesar order_by para varios campos
        if (isset($filters['order_by'])) {
            foreach ($filters['order_by'] as $order) {
                $query->orderBy(
                    $order['field'],
                    $order['direction'] ?? 'asc'
                );
            }
        }

        // Procesar condiciones AND (filtrado estándar)
        foreach ($filters as $key => $value) {
            // Excluir claves que son estructuras complejas
            if (!in_array($key, ['select', 'join', 'or', 'order_by', 'group_by', 'limit', 'offset'])) {
                // Verificar si se debe usar un operador diferente
                if (is_array($value) && isset($value['operator'])) {
                    if ($value['operator'] === 'IN' && is_array($value['value'])) {
                        // Caso 'IN'
                        $query->whereIn($key, $value['value']);
                    } else {
                        // Otros operadores como '!='
                        $query->where($key, $value['operator'], $value['value']);
                    }
                } elseif (is_array($value)) {
                    // Cuando el valor es un array (por ejemplo, para 'IN')
                    $query->whereIn($key, $value);
                } else {
                    // Filtrado estándar (valor único)
                    $query->where($key, '=', $value);
                }
            }
        }

        // Procesar group_by
        if (isset($filters['group_by'])) {
            $query->groupBy($filters['group_by']);
        }

        // Procesar limit y offset
        if (isset($filters['limit'])) {
            $query->limit($filters['limit']); // Aplica el límite de registros
        }

        if (isset($filters['offset'])) {
            $query->offset($filters['offset']); // Aplica el desplazamiento
        }

        return $query->get(); // Devuelve los resultados filtrados
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        // Crear el registro en la base de datos
        return $this->model->create($data);
    }
}
