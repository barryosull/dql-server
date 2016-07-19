<?php namespace App\Interpreter\Command;

use App\Interpreter\AstRepository;
use App\Interpreter\Validation;
use App\DQLServer\Command;

class Factory
{
    private $validator;
    private $ast_repo;
    
    public function __construct(
        Validation\Validator $validator,
        AstRepository $ast_repo
    )
    {
        $this->validator = $validator;
        $this->ast_repo = $ast_repo;
    }
    
    public function dql_command(Command $command)
    {
        $id = $command->id;
        $command_id = $command->command_id;
        $aggregate_id = $command->aggregate_id;
        $payload = $command->payload ?: [];
        $occured_at = $command->occured_at;
        
        $ast = $this->ast_repo->fetch($command_id);
        
        $result = (object)[
            "schema"=>(object)[
                'id'=>$command_id,
                'aggregate_id'=>$ast->aggregate_id
            ],
            "domain"=>(object)[
                "id"=>$id,
                "aggregate_id"=>$aggregate_id,
                'payload'=>$this->validator->validate($command_id, $payload),
                'occured_at'=>$occured_at
            ]
        ]; 
        return $result;
    }
}

