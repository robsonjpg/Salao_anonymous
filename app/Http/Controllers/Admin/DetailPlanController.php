<?php

//Listar os Detalhes do Plano

//ANTES DE TUDO, EU FUI NO TERMINAL E DIGITEI
// php artisan make:controller Admin\DetailPlanController
//Esse -m faz criar a migration tbm
//PARA CRIAR ISSO AQUI, TENDEU?

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{   
    protected $repository, $plan;
    //lembrando que o parâmetro da função n precisa possuir o mesmo nome doq está pegando
    public function __construct(DetailPlan $detailPlan, Plan $plan) //precisa importar
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        // $details = $plan->details();
        $details = $plan->details()->paginate(); //quando dá erro de links pode ser a falta do paginate()

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details,
        ]);
    }

    //Cadastrar Novo Detalhe Plano
    public function create($urlPlan)
    {   
        if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', [
            'plan' => $plan,
        ]);
    }

    public function store(Request $request, $urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        //UMA DAS FORMAS DE CADASTRAR
        // $data = $request->all();
        // $data['plan_id'] = $plan->id;
        // $this->repository->create($data);

        $plan->details()->create($request->all());
    
        return redirect()->route('details.plan.index', $plan->url);
    }
}
