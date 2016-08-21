<?php namespace App\Interpreter\Query;

class MongoFactory
{
    public function ast($ast)
    {
        return [
            'collection'=>$this->collection($ast->aggregate_id),
            'query'=>$this->make_query($ast)
        ];
    }
    
    private function collection($aggregate_id)
    {
        return "aggregate_".str_replace("-", "_", $aggregate_id);
    }
    
    private function make_query($ast)
    {
        return [
            '$match'=>$this->make_match($ast->query->where),
            '$group'=>$this->make_group($ast->query->select)
        ];
    }
    
    private function make_match($ast)
    {
        $wheres = [];
        foreach ($ast as $where_ast) {
            $wheres[$where_ast->field] = '?';
        }
        return $wheres;
    }
    
    private function make_group($ast)
    {
        return [
            '_id' =>$ast[0]->field,
            $ast[0]->alias => ['$sum' => 1]
        ];
    }
}

