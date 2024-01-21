<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;


class General extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'steps.general';
        public $response;
        public $resposta;
        public $cep;
    /*
     * Initialize step fields
     */
  public function mount() {
    $this->mergeState([
       'cep' => '',
    ]);
  }

     public function updatedStateCep($name, $value)
     {
         $this->response = Http::get("https://viacep.com.br/ws/{$name}/json/");


      
     
         if (!$this->response || isset($this->response['erro'])) {
             return false;
         }
     
         $this->mergeState([
            
             'bairro'  => $this->response['bairro'] ?? null,
             'rua'     => $this->response['logradouro'] ?? null ,
             'cidade'  => $this->response['localidade'] ?? null ,
             'estado'  => $this->response['uf'] ?? null,
         
         ]);

     
     }

  

  
    /*
    * Step icon 
    */
    public function icon(): string
    {
        return 'scissors';
    }

  

    /*
     * Step Validation
     */
    public function validate()
    {
       


        return [
          
            [
                'state.cpf'     => ['required', 'string'],
                'state.name'     => ['required', 'string'],
                'state.cep'           => ['required', 'string', 'min:9', 'max:9', function ($attribute, $value, $fail) {
                    
                    $this->resposta = Http::get("https://viacep.com.br/ws/{$value}/json/");
    
                
                    if (!$this->resposta || isset($this->resposta['erro'])) {
                        $fail(__('Cep Inválido'));
                    }
                }],
                'state.bairro'    => ['required', 'string',   function ($attribute, $value, $fail) {
                    if(isset($this->resposta['erro'])) {
                       return false;
                    } else {
                    $expectedBairro = $this->resposta['bairro'] ?? null;
                    if ($expectedBairro !== $value) {
                        $fail(__('Bairro Inválido. Esperado: ' . $expectedBairro));
                    }
                }
                 
                }],
                'state.cidade'    => ['required', 'string', function ($attribute, $value, $fail) {
                    if(isset($this->resposta['erro'])) {
                        return;
                    }
                    $expectedCidade = $this->resposta['localidade'] ?? null;
                    if ($expectedCidade !== $value) {
                        $fail(__('Cidade Inválida. Esperado: ' . $expectedCidade));
                    }    
             }],
                'state.estado'    => ['required', 'string', function ($attribute, $value, $fail) {
                    if(isset($this->resposta['erro'])) {
                        return;
                    }
                    $expectedEstado = $this->resposta['uf'] ?? null;
                    if ($expectedEstado !== $value) {
                        $fail(__('Estado Inválido. Esperado: ' . $expectedEstado));
                    }    
             }],
                'state.complemento'    => ['required', 'string',],
                'state.rua'  => ['required', 'string', function ($attribute, $value, $fail) {
                    if(isset($this->resposta['erro'])) {
                        return;
                    }
                    $expectedRua = $this->resposta['logradouro'] ?? null;
                    if ($expectedRua !== $value) {
                        $fail(__('Rua Inválida. Esperado: ' . $expectedRua));
                    }    
             }],
                'state.slug'         => ['required', 'string', 'unique:barbearias,slug'],
            ],
            [],
            [
                'state.name'     => __('Nome'),
                'state.bairro'    => __('Bairro'),
                'state.cep'    => __('Cep'),
                'state.estado'    => __('Estado'),
                'state.complemento'    => __('Complemento'),
                'state.rua'    => __('Rua'),
                'state.slug'    => __('URL'),
                'state.cidade' => __('Cidade'),
                
            ],
        ];
    }

    /*
     * Step Title
     */
    public function title(): string
    {
        return __('Geral');
    }
} 