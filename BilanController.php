<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bilan;
use App\Models\Pref;
use App\Models\Ville;
use App\Models\Prevalide;
use App\Models\Eloignement;
use App\Models\Gespagnole;
use App\Models\Assaut;
use Session;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;

class BilanController extends Controller
{
    public function drop(Request $request){
        $region=Prevalide::where('user',Session::get('user'))->delete();
        return  response()->json("hello");}
    public function addBilan(Request $request){
        try{
            $bilan_lieu=Prevalide::where('user',Session::get('user'))
            ->where('traite',0)
            ->get();
            $date = $request->date;
            $mois = explode('-',$date)[0].'-'.explode('-',$date)[1];
            if($bilan_lieu->count()){
           // dd($request->nbre_interceptes);
            
            foreach($bilan_lieu as $b){
                $bilan = Bilan::create([
                    'operation'=>"$request->operation",
                    'jour' => "$request->date",
                    'mois' => "$mois",
                    'tranche_horaire'=>"$request->tranche_horaire" ,
                    'nb_op_ratissage'=>$request->nbr_op_ratissage ,
                    'nationalite'=>"$request->nationalite",
                    'nbre_interceptes'=>$request->nbre_intercepte ,
                    'nbre_femmes'=>$request->nbre_femmes,
                    'nbre_hommes'=>$request->nbre_hommes ,
                    'region'=>"$b->region",
                    'pref'=>"$b->pref",
                    'ville'=>"$b->ville" ,
                    'quartier'=>"$b->quartier" ,
                    'nbre_pers_lieu'=>$b->nbre_pers_lieu ,
                    'nbre_pers_15ans'=>$request->nbre_pers_15ans,
                    'nbre_pers_15_17ans'=>$request->nbre_pers_15_17ans ,
                    'nbre_pers_18_30ans'=>$request->nbre_pers_18_30ans ,
                    'nbre_pers_31_40ans'=>$request->nbre_pers_31_40ans ,
                    'nbre_pers_41_50ans'=>$request->nbre_pers_41_50ans ,
                    'nbre_pers_50ans'=>$request->nbre_pers_50ans,   
                    'ville_saisie'=>$request->ville_saisie,      
                ]);
            }}
            else{
                //dd("hello");
                $bilan = Bilan::create([
                    'operation'=>"$request->operation",
                    'jour' => "$request->date",
                    'mois' => "$mois",
                    'tranche_horaire'=>"$request->tranche_horaire" ,
                    'nb_op_ratissage'=>$request->nbr_op_ratissage ,
                    'nationalite'=>"$request->nationalite",
                    'nbre_interceptes'=>$request->nbre_intercepte ,
                    'nbre_femmes'=>$request->nbre_femmes,
                    'nbre_hommes'=>$request->nbre_hommes ,
                    'region'=>"NULL",
                    'pref'=>"NULL",
                    'ville'=>"NULL" ,
                    'quartier'=>"NULL" ,
                    'nbre_pers_lieu'=>0 ,
                    'nbre_pers_15ans'=>$request->nbre_pers_15ans,
                    'nbre_pers_15_17ans'=>$request->nbre_pers_15_17ans ,
                    'nbre_pers_18_30ans'=>$request->nbre_pers_18_30ans ,
                    'nbre_pers_31_40ans'=>$request->nbre_pers_31_40ans ,
                    'nbre_pers_41_50ans'=>$request->nbre_pers_41_50ans ,
                    'nbre_pers_50ans'=>$request->nbre_pers_50ans,   
                    'ville_saisie'=>$request->ville_saisie,      
                ]);
            }
            if($bilan){
                
                Prevalide::where('user',Session::get('user'))->delete();
                return redirect()->back()->with('message', 'les informations sont bien ajoutées');
            }else{
                return back()->withErrors(['message'=>'Une erreur a étè introduite lors de l insertion des données!!!']);
            }
           
                
        }
        catch(\Exception $e){
            \Log::error($e);
        }
    }

    public function addBilanFix(Request $request){
        try{
            $bilan_lieu=Prevalide::where('user',Session::get('user'))
            ->where('traite',0)
            ->get();
           // dd($request->nbre_interceptes);
            $date = $request->date;
            
            $mois = explode('-',$date)[1].'-'.explode('-',$date)[0];
            foreach($bilan_lieu as $b){
                $bilan = Bilan::create([
                    'operation'=>"$request->operation",
                    'jour' => "$request->date",
                    'mois' => "$mois",
                    'tranche_horaire'=>"$request->tranche_horaire" ,
                    'nb_op_ratissage'=>$request->nbr_op_ratissage ,
                    'nationalite'=>"$request->nationalite",
                    'nbre_interceptes'=>$request->nbre_intercepte ,
                    'nbre_femmes'=>$request->nbre_femmes,
                    'nbre_hommes'=>$request->nbre_hommes ,
                    'region'=>"$b->region",
                    'pref'=>"$b->pref",
                    'ville'=>"$b->ville" ,
                    'quartier'=>"$b->quartier" ,
                    'nbre_pers_lieu'=>$b->nbre_pers_lieu ,
                    'nbre_pers_15ans'=>$request->nbre_pers_15ans,
                    'nbre_pers_15_17ans'=>$request->nbre_pers_15_17ans ,
                    'nbre_pers_18_30ans'=>$request->nbre_pers_18_30ans ,
                    'nbre_pers_31_40ans'=>$request->nbre_pers_31_40ans ,
                    'nbre_pers_41_50ans'=>$request->nbre_pers_41_50ans ,
                    'nbre_pers_50ans'=>$request->nbre_pers_50ans,   
                    'nbre_sn'=>$request->nbre_SN ,
                    'nbre_gr'=>$request->nbre_GR ,
                    'nbre_fa'=>$request->nbre_FA,  
                    'ville_saisie'=>Session::get('ville'),      
                ]);
            }
            if($bilan){
                Prevalide::where('user',Session::get('user'))->delete();
                return redirect()->back()->with('message', 'les informations sont bien ajoutées');
            }else{
                return back()->withErrors(['message'=>'Une erreur a étè introduite lors de l insertion des données!!!']);
            }
           
                
        }
        catch(\Exception $e){
            \Log::error($e);
        }
    }
    public function BilanOperation(){
        
        return view('admin.bilan_operation_eloignement');

    }

    public function BilanRechercheOperation(Request $request){
        Session::put('date_debut_eloi', $request->date_debut);
        Session::put('date_fin_eloi', $request->date_fin);
        
        $date_debut=$request->date_debut;
        $date_fin=$request->date_fin;
        $total_ville=array();
        if($date_fin){
            $data=Eloignement::whereBetween('date',[$date_debut,$date_fin])
            ->get();
            
            //dd($data[0]->ville);
            $period = new DatePeriod(
                new DateTime("$date_debut"),
                new DateInterval('P1D'),
                new DateTime("$date_fin"));
            foreach($period as $p){
                $ville=DB::table('eloignements')
                ->whereBetween('date',[$date_debut,$date_fin])
                ->select('date','ville_eloignement',DB::raw("SUM(nbre_sn) as total_sn"),DB::raw("SUM(nbre_fa) as total_fa"),DB::raw("SUM(nbre_gr) as total_gr"),DB::raw("SUM(total_ville) as count"),DB::raw("SUM(nbre_mar) as count_mar"),DB::raw("SUM(nbre_sub) as count_sub"),DB::raw("SUM(nbre_autres) as count_autres"))
                ->groupBy('date','ville_eloignement')
                ->having('date','=',$p->format('Y-m-d'))
                ->get();
                $ville1=$ville;
                //dd($ville);
                foreach($ville as $v){
                    //dd($v);
                if(!empty($v->ville_eloignement)){
                    $date=$p->format('Y-m-d');
                    $date_tab[]=$date;
                    $total_ville[$date]=$ville;
                    }
                break;
            }
        }
        
           
       
        }else{
            $data=Eloignement::where('date',$date_debut)
            ->get();
            $period = new DatePeriod(
                new DateTime("$date_debut"),
                new DateInterval('P1D'),
                new DateTime("$date_fin"));
           
            
            $ville=DB::table('eloignements')
            ->select('date','ville_eloignement',DB::raw("SUM(total_ville) as count"))
            ->groupBy('date','ville_eloignement')
            ->having('date','=',$date_debut)
            ->get();
            
            $date=$date_debut;
            $date_tab[]=$date_debut;
            $total_ville[$date]=$ville;
        //dd($date_tab);  
                
        }
        //dd($ville);
        return view('admin.bilan_recherche_op_eloignement',compact(['data','ville1','date_tab','total_ville','period','date_debut','date_fin','ville']));

    }
    public function BilanPeriodique(){
        $bilan_martil=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_fnideq=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_mdiq=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_alliyenne=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_bellyounech=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        return view('admin.dashboard',compact(['bilan_mdiq','bilan_fnideq','bilan_martil','bilan_alliyenne','bilan_bellyounech']));

    }
    public function BilanJournalier(){
        $bilan_martil=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_fnideq=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_mdiq=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_alliyenne=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_bellyounech=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        return view('admin.dashboard2',compact(['bilan_mdiq','bilan_fnideq','bilan_martil','bilan_alliyenne','bilan_bellyounech']));

    }
    public function BilanMensuel(){
        $bilan_martil=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_fnideq=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_mdiq=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_alliyenne=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_bellyounech=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        return view('admin.dashboard3',compact(['bilan_mdiq','bilan_fnideq','bilan_martil','bilan_alliyenne','bilan_bellyounech']));

    }

    public function BilanAnnuel(){
        $bilan_martil=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_fnideq=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_mdiq=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_alliyenne=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        $bilan_bellyounech=Bilan::where('ville','martil')
        ->where('jour','LIKE',date('Y-m-d').'%')
        ->get();
        return view('admin.dashboard4',compact(['bilan_mdiq','bilan_fnideq','bilan_martil','bilan_alliyenne','bilan_bellyounech']));

    }
    public function bilan_tranche_horaire(Request $request){
        $operation=$request->operation;
        $date=$request->date;
        $tranche_horaire=$request->tranche_horaire;
        $ville=$request->ville;
        //dd($ville);
        Session::put('operation', $request->operation);
        Session::put('date', $request->date);
        Session::put('tranche_horaire', $request->tranche_horaire);
        Session::put('ville', $request->ville);
        $bilan_operation=Bilan::where('operation',"$request->operation")
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->where('tranche_horaire',"$request->tranche_horaire")
        ->get();
        $bilan_operation_mar=Bilan::where('operation',"$request->operation")
        ->where('nationalite','marocain')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->where('tranche_horaire',"$request->tranche_horaire")
        ->get();
        $bilan_operation_sub=Bilan::where('operation',"$request->operation")
        ->where('nationalite','subsaharien')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->where('tranche_horaire',"$request->tranche_horaire")
        ->get();
        $bilan_operation_autres=Bilan::where('operation',"$request->operation")
        ->where('nationalite','Autres nationalites')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->where('tranche_horaire',"$request->tranche_horaire")
        ->get();
        
        $bilan_par_ville=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','marocain')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->where('tranche_horaire',"$request->tranche_horaire")
        ->select('ville',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('ville')
        ->get();
        $bilan_par_pays_su=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','subsaharien')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->where('tranche_horaire',"$request->tranche_horaire")
        ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('region')
        ->get();
        $bilan_par_pays_autres=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','Autres nationalites')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->where('tranche_horaire',"$request->tranche_horaire")
        ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('region')
        ->get();
        $total_femmes_mar=0;
        $total_hommes_mar=0;
        $total_15ans_marocain=0;
        $total_15_17ans_marocain=0;
        $total_18_30ans_marocain=0;
        $total_31_40ans_marocain=0;
        $total_41_50ans_marocain=0;
        $total_50ans_marocain=0;

        $total_femmes_sub=0;
        $total_hommes_sub=0;
        $total_15ans_sub=0;
        $total_15_17ans_sub=0;
        $total_18_30ans_sub=0;
        $total_31_40ans_sub=0;
        $total_41_50ans_sub=0;
        $total_50ans_sub=0;

        $total_femmes_autres=0;
        $total_hommes_autres=0;
        $total_15ans_autres=0;
        $total_15_17ans_autres=0;
        $total_18_30ans_autres=0;
        $total_31_40ans_autres=0;
        $total_41_50ans_autres=0;
        $total_50ans_autres=0;
           
        foreach($bilan_operation_mar as $b){
          $total_femmes_mar+=$b->nbre_femmes;
          $total_hommes_mar+=$b->nbre_hommes;

          $total_15ans_marocain+=$b->nbre_pers_15ans;
          $total_15_17ans_marocain+=$b->nbre_pers_15_17ans;
          $total_18_30ans_marocain+=$b->nbre_pers_18_30ans;
          $total_31_40ans_marocain+=$b->nbre_pers_31_40ans;
          $total_41_50ans_marocain+=$b->nbre_pers_41_50ans;
          $total_50ans_marocain+=$b->nbre_pers_50ans;
           
        }
        //dd($b->nbre_15ans);
        foreach($bilan_operation_sub as $b){
            $total_femmes_sub+=$b->nbre_femmes;
            $total_hommes_sub+=$b->nbre_hommes;
  
            $total_15ans_sub+=$b->nbre_pers_15ans;
            $total_15_17ans_sub+=$b->nbre_pers_15_17ans;
            $total_18_30ans_sub+=$b->nbre_pers_18_30ans;
            $total_31_40ans_sub+=$b->nbre_pers_31_40ans;
            $total_41_50ans_sub+=$b->nbre_pers_41_50ans;
            $total_50ans_sub+=$b->nbre_pers_50ans;
             
          }
          foreach($bilan_operation_autres as $b){
            $total_femmes_autres+=$b->nbre_femmes;
            $total_hommes_autres+=$b->nbre_hommes;
  
            $total_15ans_autres+=$b->nbre_pers_15ans;
            $total_15_17ans_autres+=$b->nbre_pers_15_17ans;
            $total_18_30ans_autres+=$b->nbre_pers_18_30ans;
            $total_31_40ans_autres+=$b->nbre_pers_31_40ans;
            $total_41_50ans_autres+=$b->nbre_pers_41_50ans;
            $total_50ans_autres+=$b->nbre_pers_50ans;
             
          }
          $data = [];
         
            
        //$data['bilan_operation'][] = $bilan_operation;
        $data['operation'][] = $operation;
        $data['date'][] = $date;
        $data['tranche_horaire'][] = $tranche_horaire;
        $data['ville'][] = $ville;
        $data['total_femmes_mar'][] = $total_femmes_mar;
        $data['total_15ans_marocain'][] = $total_15ans_marocain;
        $data['total_15_17ans_marocain'][] = $total_15_17ans_marocain;
        $data['total_18_30ans_marocain'][] = $total_18_30ans_marocain;
        $data['total_hommes_mar'][] = $total_hommes_mar;
        $data['total_31_40ans_marocain'][] = $total_31_40ans_marocain;

        $data['total_41_50ans_marocain'][] = $total_41_50ans_marocain;
        $data['total_50ans_marocain'][] = $total_50ans_marocain;
        $data['total_femmes_sub'][] = $total_femmes_sub;
        $data['total_hommes_sub'][] = $total_hommes_sub;
        $data['total_15ans_sub'][] = $total_15ans_sub;

        $data['total_15_17ans_sub'][] = $total_15_17ans_sub;
        $data['total_18_30ans_sub'][] = $total_18_30ans_sub;
        $data['total_31_40ans_sub'][] = $total_31_40ans_sub;
        $data['total_41_50ans_sub'][] = $total_41_50ans_sub;
        $data['total_50ans_sub'][] = $total_50ans_sub;

        $data['total_femmes_autres'][] = $total_femmes_autres;
        $data['total_hommes_autres'][] = $total_hommes_autres;
        $data['total_15ans_autres'][] = $total_15ans_autres;
        $data['total_15_17ans_autres'][] = $total_15_17ans_autres;
        $data['total_18_30ans_autres'][] = $total_18_30ans_autres;
        
        $data['total_31_40ans_autres'][] = $total_31_40ans_autres;
        $data['total_41_50ans_autres'][] = $total_41_50ans_autres;
        $data['total_50ans_autres'][] = $total_50ans_autres;
        foreach($bilan_par_ville as $b){
            $data['labels_ville'][] = $b->ville;
            $data['total_par_ville'][] = $b->count;
        }
        foreach($bilan_par_pays_su as $b){
            $data['labels_pays_sub'][] = $b->region;
            $data['total_par_pays_sub'][] = $b->count;
        }
        foreach($bilan_par_pays_autres as $b){
            $data['labels_par_pays_autres'][] = $b->region;
            $data['total_par_pays_autres'][] = $b->count;
        }
        
       
   
        $data['chart_data'] = json_encode($data);
        //dd($total_femmes_mar);
       return view('admin.recherche_bilan',compact(['data','bilan_operation','operation','date','tranche_horaire','ville'
    ,'total_femmes_mar','total_hommes_mar','total_15ans_marocain','total_15_17ans_marocain','total_18_30ans_marocain','total_31_40ans_marocain',
    'total_41_50ans_marocain','total_50ans_marocain','total_femmes_sub','total_hommes_sub','total_15ans_sub',
    'total_15_17ans_sub','total_18_30ans_sub','total_31_40ans_sub','total_41_50ans_sub','total_50ans_sub',
    'total_femmes_autres','total_hommes_autres','total_15ans_autres','total_15_17ans_autres','total_18_30ans_autres',
    'total_31_40ans_autres','total_41_50ans_autres','total_50ans_autres','bilan_par_ville','bilan_par_pays_su','bilan_par_pays_autres']));
    }
    public function bilan_jour(Request $request){
        $operation=$request->operation;
        $date=$request->date;
        $ville=$request->ville;
        $date_fin=$request->date_fin;
        Session::put('operation', $request->operation);
        Session::put('date', $request->date);
        Session::put('ville', $request->ville);
        Session::put('date_fin', $request->date_fin);
        if(!$date_fin){
        
        $bilan_operation=Bilan::where('operation',"$request->operation")
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->get();
        $bilan_operation_mar=Bilan::where('operation',"$request->operation")
        ->where('nationalite','marocain')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->get();
        $bilan_operation_sub=Bilan::where('operation',"$request->operation")
        ->where('nationalite','subsaharien')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->get();
        $bilan_operation_autres=Bilan::where('operation',"$request->operation")
        ->where('nationalite','Autres nationalites')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->get();
        
        $bilan_par_ville=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','marocain')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->select('ville',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('ville')
        ->get();
        $bilan_par_pays_su=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','subsaharien')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('region')
        ->get();
        $bilan_par_pays_autres=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','Autres nationalites')
        ->where('ville_saisie',"$request->ville")
        ->where('jour',"$request->date")
        ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('region')
        ->get();}
        else{
            $bilan_operation=Bilan::where('operation',"$request->operation")
            ->where('ville_saisie',"$request->ville")
            ->whereBetween('jour', ["$request->date", "$request->date_fin"])
            ->get();
            $bilan_operation_mar=Bilan::where('operation',"$request->operation")
            ->where('nationalite','marocain')
            ->where('ville_saisie',"$request->ville")
            ->whereBetween('jour', ["$request->date", "$request->date_fin"])
            ->get();
            $bilan_operation_sub=Bilan::where('operation',"$request->operation")
            ->where('nationalite','subsaharien')
            ->where('ville_saisie',"$request->ville")
            ->whereBetween('jour', ["$request->date", "$request->date_fin"])
            ->where('jour',"$request->date")
            ->get();
            $bilan_operation_autres=Bilan::where('operation',"$request->operation")
            ->where('nationalite','Autres nationalites')
            ->where('ville_saisie',"$request->ville")
            ->whereBetween('jour', ["$request->date", "$request->date_fin"])
            ->where('jour',"$request->date")
            ->get();
            
            $bilan_par_ville=DB::table('bilans')
            ->where('operation',"$request->operation")
            ->where('nationalite','marocain')
            ->where('ville_saisie',"$request->ville")
            ->whereBetween('jour', ["$request->date", "$request->date_fin"])
            ->select('ville',DB::raw("SUM(nbre_pers_lieu) as count"))
            ->groupBy('ville')
            ->get();
            $bilan_par_pays_su=DB::table('bilans')
            ->where('operation',"$request->operation")
            ->where('nationalite','subsaharien')
            ->where('ville_saisie',"$request->ville")
            ->whereBetween('jour', ["$request->date", "$request->date_fin"])
            ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
            ->groupBy('region')
            ->get();
            $bilan_par_pays_autres=DB::table('bilans')
            ->where('operation',"$request->operation")
            ->where('nationalite','Autres nationalites')
            ->where('ville_saisie',"$request->ville")
            ->whereBetween('jour', ["$request->date", "$request->date_fin"])
            ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
            ->groupBy('region')
            ->get();
        }
        $total_femmes_mar=0;
        $total_hommes_mar=0;
        $total_15ans_marocain=0;
        $total_15_17ans_marocain=0;
        $total_18_30ans_marocain=0;
        $total_31_40ans_marocain=0;
        $total_41_50ans_marocain=0;
        $total_50ans_marocain=0;

        $total_femmes_sub=0;
        $total_hommes_sub=0;
        $total_15ans_sub=0;
        $total_15_17ans_sub=0;
        $total_18_30ans_sub=0;
        $total_31_40ans_sub=0;
        $total_41_50ans_sub=0;
        $total_50ans_sub=0;

        $total_femmes_autres=0;
        $total_hommes_autres=0;
        $total_15ans_autres=0;
        $total_15_17ans_autres=0;
        $total_18_30ans_autres=0;
        $total_31_40ans_autres=0;
        $total_41_50ans_autres=0;
        $total_50ans_autres=0;
           
        foreach($bilan_operation_mar as $b){
          $total_femmes_mar+=$b->nbre_femmes;
          $total_hommes_mar+=$b->nbre_hommes;

          $total_15ans_marocain+=$b->nbre_pers_15ans;
          $total_15_17ans_marocain+=$b->nbre_pers_15_17ans;
          $total_18_30ans_marocain+=$b->nbre_pers_18_30ans;
          $total_31_40ans_marocain+=$b->nbre_pers_31_40ans;
          $total_41_50ans_marocain+=$b->nbre_pers_41_50ans;
          $total_50ans_marocain+=$b->nbre_pers_50ans;
           
        }
        //dd($b->nbre_15ans);
        foreach($bilan_operation_sub as $b){
            $total_femmes_sub+=$b->nbre_femmes;
            $total_hommes_sub+=$b->nbre_hommes;
  
            $total_15ans_sub+=$b->nbre_pers_15ans;
            $total_15_17ans_sub+=$b->nbre_pers_15_17ans;
            $total_18_30ans_sub+=$b->nbre_pers_18_30ans;
            $total_31_40ans_sub+=$b->nbre_pers_31_40ans;
            $total_41_50ans_sub+=$b->nbre_pers_41_50ans;
            $total_50ans_sub+=$b->nbre_pers_50ans;
             
          }
          foreach($bilan_operation_autres as $b){
            $total_femmes_autres+=$b->nbre_femmes;
            $total_hommes_autres+=$b->nbre_hommes;
  
            $total_15ans_autres+=$b->nbre_pers_15ans;
            $total_15_17ans_autres+=$b->nbre_pers_15_17ans;
            $total_18_30ans_autres+=$b->nbre_pers_18_30ans;
            $total_31_40ans_autres+=$b->nbre_pers_31_40ans;
            $total_41_50ans_autres+=$b->nbre_pers_41_50ans;
            $total_50ans_autres+=$b->nbre_pers_50ans;
             
          }

          $data = [];
         
            
        //$data['bilan_operation'][] = $bilan_operation;
        $data['operation'][] = $operation;
        $data['date'][] = $date;
        $data['ville'][] = $ville;
        $data['total_femmes_mar'][] = $total_femmes_mar;
        $data['total_15ans_marocain'][] = $total_15ans_marocain;
        $data['total_15_17ans_marocain'][] = $total_15_17ans_marocain;
        $data['total_18_30ans_marocain'][] = $total_18_30ans_marocain;
        $data['total_hommes_mar'][] = $total_hommes_mar;
        $data['total_31_40ans_marocain'][] = $total_31_40ans_marocain;

        $data['total_41_50ans_marocain'][] = $total_41_50ans_marocain;
        $data['total_50ans_marocain'][] = $total_50ans_marocain;
        $data['total_femmes_sub'][] = $total_femmes_sub;
        $data['total_hommes_sub'][] = $total_hommes_sub;
        $data['total_15ans_sub'][] = $total_15ans_sub;

        $data['total_15_17ans_sub'][] = $total_15_17ans_sub;
        $data['total_18_30ans_sub'][] = $total_18_30ans_sub;
        $data['total_31_40ans_sub'][] = $total_31_40ans_sub;
        $data['total_41_50ans_sub'][] = $total_41_50ans_sub;
        $data['total_50ans_sub'][] = $total_50ans_sub;

        $data['total_femmes_autres'][] = $total_femmes_autres;
        $data['total_hommes_autres'][] = $total_hommes_autres;
        $data['total_15ans_autres'][] = $total_15ans_autres;
        $data['total_15_17ans_autres'][] = $total_15_17ans_autres;
        $data['total_18_30ans_autres'][] = $total_18_30ans_autres;
        
        $data['total_31_40ans_autres'][] = $total_31_40ans_autres;
        $data['total_41_50ans_autres'][] = $total_41_50ans_autres;
        $data['total_50ans_autres'][] = $total_50ans_autres;
        foreach($bilan_par_ville as $b){
            $data['labels_ville'][] = $b->ville;
            $data['total_par_ville'][] = $b->count;
        }
        foreach($bilan_par_pays_su as $b){
            $data['labels_pays_sub'][] = $b->region;
            $data['total_par_pays_sub'][] = $b->count;
        }
        foreach($bilan_par_pays_autres as $b){
            $data['labels_par_pays_autres'][] = $b->region;
            $data['total_par_pays_autres'][] = $b->count;
        }
        
       
   
        $data['chart_data'] = json_encode($data);
        
       return view('admin.recherche_bilan_journalier',compact(['data','bilan_operation','operation','date','ville'
    ,'total_femmes_mar','total_hommes_mar','total_15ans_marocain','total_15_17ans_marocain','total_18_30ans_marocain','total_31_40ans_marocain',
    'total_41_50ans_marocain','total_50ans_marocain','total_femmes_sub','total_hommes_sub','total_15ans_sub',
    'total_15_17ans_sub','total_18_30ans_sub','total_31_40ans_sub','total_41_50ans_sub','total_50ans_sub',
    'total_femmes_autres','total_hommes_autres','total_15ans_autres','total_15_17ans_autres','total_18_30ans_autres',
    'total_31_40ans_autres','total_41_50ans_autres','total_50ans_autres','bilan_par_ville','bilan_par_pays_su','bilan_par_pays_autres']));
    }


    public function bilan_mois(Request $request){
        $operation=$request->operation;
        $date=$request->date;
        $ville=$request->ville;
        Session::put('operation', $request->operation);
        Session::put('date', $request->date);
        Session::put('ville', $request->ville);
        $bilan_operation=Bilan::where('operation',"$request->operation")
        ->where('ville_saisie',"$request->ville")
        ->where('mois',"$request->date")
        ->get();
        $bilan_operation_mar=Bilan::where('operation',"$request->operation")
        ->where('nationalite','marocain')
        ->where('ville_saisie',"$request->ville")
        ->where('mois',"$request->date")
        ->get();
        $bilan_operation_sub=Bilan::where('operation',"$request->operation")
        ->where('nationalite','subsaharien')
        ->where('ville_saisie',"$request->ville")
        ->where('mois',"$request->date")
        ->get();
        $bilan_operation_autres=Bilan::where('operation',"$request->operation")
        ->where('nationalite','Autres nationalites')
        ->where('ville_saisie',"$request->ville")
        ->where('mois',"$request->date")
        ->get();
        
        $bilan_par_ville=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','marocain')
        ->where('ville_saisie',"$request->ville")
        ->where('mois',"$request->date")
        ->select('ville',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('ville')
        ->get();
        $bilan_par_pays_su=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','subsaharien')
        ->where('ville_saisie',"$request->ville")
        ->where('mois',"$request->date")
        ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('region')
        ->get();
        $bilan_par_pays_autres=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','Autres nationalites')
        ->where('ville_saisie',"$request->ville")
        ->where('mois',"$request->date")
        ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('region')
        ->get();
        $total_femmes_mar=0;
        $total_hommes_mar=0;
        $total_15ans_marocain=0;
        $total_15_17ans_marocain=0;
        $total_18_30ans_marocain=0;
        $total_31_40ans_marocain=0;
        $total_41_50ans_marocain=0;
        $total_50ans_marocain=0;

        $total_femmes_sub=0;
        $total_hommes_sub=0;
        $total_15ans_sub=0;
        $total_15_17ans_sub=0;
        $total_18_30ans_sub=0;
        $total_31_40ans_sub=0;
        $total_41_50ans_sub=0;
        $total_50ans_sub=0;

        $total_femmes_autres=0;
        $total_hommes_autres=0;
        $total_15ans_autres=0;
        $total_15_17ans_autres=0;
        $total_18_30ans_autres=0;
        $total_31_40ans_autres=0;
        $total_41_50ans_autres=0;
        $total_50ans_autres=0;
           
        foreach($bilan_operation_mar as $b){
          $total_femmes_mar+=$b->nbre_femmes;
          $total_hommes_mar+=$b->nbre_hommes;

          $total_15ans_marocain+=$b->nbre_pers_15ans;
          $total_15_17ans_marocain+=$b->nbre_pers_15_17ans;
          $total_18_30ans_marocain+=$b->nbre_pers_18_30ans;
          $total_31_40ans_marocain+=$b->nbre_pers_31_40ans;
          $total_41_50ans_marocain+=$b->nbre_pers_41_50ans;
          $total_50ans_marocain+=$b->nbre_pers_50ans;
           
        }
        //dd($b->nbre_15ans);
        foreach($bilan_operation_sub as $b){
            $total_femmes_sub+=$b->nbre_femmes;
            $total_hommes_sub+=$b->nbre_hommes;
  
            $total_15ans_sub+=$b->nbre_pers_15ans;
            $total_15_17ans_sub+=$b->nbre_pers_15_17ans;
            $total_18_30ans_sub+=$b->nbre_pers_18_30ans;
            $total_31_40ans_sub+=$b->nbre_pers_31_40ans;
            $total_41_50ans_sub+=$b->nbre_pers_41_50ans;
            $total_50ans_sub+=$b->nbre_pers_50ans;
             
          }
          foreach($bilan_operation_autres as $b){
            $total_femmes_autres+=$b->nbre_femmes;
            $total_hommes_autres+=$b->nbre_hommes;
  
            $total_15ans_autres+=$b->nbre_pers_15ans;
            $total_15_17ans_autres+=$b->nbre_pers_15_17ans;
            $total_18_30ans_autres+=$b->nbre_pers_18_30ans;
            $total_31_40ans_autres+=$b->nbre_pers_31_40ans;
            $total_41_50ans_autres+=$b->nbre_pers_41_50ans;
            $total_50ans_autres+=$b->nbre_pers_50ans;
             
          }
          $data = [];
         
            
          //$data['bilan_operation'][] = $bilan_operation;
          $data['operation'][] = $operation;
          $data['date'][] = $date;
          $data['ville'][] = $ville;
          $data['total_femmes_mar'][] = $total_femmes_mar;
          $data['total_15ans_marocain'][] = $total_15ans_marocain;
          $data['total_15_17ans_marocain'][] = $total_15_17ans_marocain;
          $data['total_18_30ans_marocain'][] = $total_18_30ans_marocain;
          $data['total_hommes_mar'][] = $total_hommes_mar;
          $data['total_31_40ans_marocain'][] = $total_31_40ans_marocain;
  
          $data['total_41_50ans_marocain'][] = $total_41_50ans_marocain;
          $data['total_50ans_marocain'][] = $total_50ans_marocain;
          $data['total_femmes_sub'][] = $total_femmes_sub;
          $data['total_hommes_sub'][] = $total_hommes_sub;
          $data['total_15ans_sub'][] = $total_15ans_sub;
  
          $data['total_15_17ans_sub'][] = $total_15_17ans_sub;
          $data['total_18_30ans_sub'][] = $total_18_30ans_sub;
          $data['total_31_40ans_sub'][] = $total_31_40ans_sub;
          $data['total_41_50ans_sub'][] = $total_41_50ans_sub;
          $data['total_50ans_sub'][] = $total_50ans_sub;
  
          $data['total_femmes_autres'][] = $total_femmes_autres;
          $data['total_hommes_autres'][] = $total_hommes_autres;
          $data['total_15ans_autres'][] = $total_15ans_autres;
          $data['total_15_17ans_autres'][] = $total_15_17ans_autres;
          $data['total_18_30ans_autres'][] = $total_18_30ans_autres;
          
          $data['total_31_40ans_autres'][] = $total_31_40ans_autres;
          $data['total_41_50ans_autres'][] = $total_41_50ans_autres;
          $data['total_50ans_autres'][] = $total_50ans_autres;
          foreach($bilan_par_ville as $b){
              $data['labels_ville'][] = $b->ville;
              $data['total_par_ville'][] = $b->count;
          }
          foreach($bilan_par_pays_su as $b){
              $data['labels_pays_sub'][] = $b->region;
              $data['total_par_pays_sub'][] = $b->count;
          }
          foreach($bilan_par_pays_autres as $b){
              $data['labels_par_pays_autres'][] = $b->region;
              $data['total_par_pays_autres'][] = $b->count;
          }
          
         
     
          $data['chart_data'] = json_encode($data);
       return view('admin.recherche_bilan_mensuel',compact(['data','bilan_operation','operation','date','ville'
    ,'total_femmes_mar','total_hommes_mar','total_15ans_marocain','total_15_17ans_marocain','total_18_30ans_marocain','total_31_40ans_marocain',
    'total_41_50ans_marocain','total_50ans_marocain','total_femmes_sub','total_hommes_sub','total_15ans_sub',
    'total_15_17ans_sub','total_18_30ans_sub','total_31_40ans_sub','total_41_50ans_sub','total_50ans_sub',
    'total_femmes_autres','total_hommes_autres','total_15ans_autres','total_15_17ans_autres','total_18_30ans_autres',
    'total_31_40ans_autres','total_41_50ans_autres','total_50ans_autres','bilan_par_ville','bilan_par_pays_su','bilan_par_pays_autres']));
    }

    public function bilan_annee(Request $request){
        $operation=$request->operation;
        $date=$request->date;
        $ville=$request->ville;
        Session::put('operation', $request->operation);
        Session::put('date', $request->date);
        Session::put('ville', $request->ville);
        $bilan_operation=Bilan::where('operation',"$request->operation")
        ->where('ville_saisie',"$request->ville")
        ->where('jour','LIKE',"$request->date",'%')
        ->get();
        $bilan_operation_mar=Bilan::where('operation',"$request->operation")
        ->where('nationalite','marocain')
        ->where('ville_saisie',"$request->ville")
        ->where('jour','LIKE',"$request->date",'%')
        ->get();
        $bilan_operation_sub=Bilan::where('operation',"$request->operation")
        ->where('nationalite','subsaharien')
        ->where('ville_saisie',"$request->ville")
        ->where('jour','LIKE',"$request->date",'%')
        ->get();
        $bilan_operation_autres=Bilan::where('operation',"$request->operation")
        ->where('nationalite','Autres nationalites')
        ->where('ville_saisie',"$request->ville")
        ->where('jour','LIKE',"$request->date",'%')
        ->get();
        
        $bilan_par_ville=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','marocain')
        ->where('ville_saisie',"$request->ville")
        ->where('jour','LIKE',"$request->date",'%')
        ->select('ville',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('ville')
        ->get();
        $bilan_par_pays_su=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','subsaharien')
        ->where('ville_saisie',"$request->ville")
        ->where('jour','LIKE',"$request->date",'%')
        ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('region')
        ->get();
        $bilan_par_pays_autres=DB::table('bilans')
        ->where('operation',"$request->operation")
        ->where('nationalite','Autres nationalites')
        ->where('ville_saisie',"$request->ville")
        ->where('jour','LIKE',"$request->date",'%')
        ->select('region',DB::raw("SUM(nbre_pers_lieu) as count"))
        ->groupBy('region')
        ->get();
        $total_femmes_mar=0;
        $total_hommes_mar=0;
        $total_15ans_marocain=0;
        $total_15_17ans_marocain=0;
        $total_18_30ans_marocain=0;
        $total_31_40ans_marocain=0;
        $total_41_50ans_marocain=0;
        $total_50ans_marocain=0;

        $total_femmes_sub=0;
        $total_hommes_sub=0;
        $total_15ans_sub=0;
        $total_15_17ans_sub=0;
        $total_18_30ans_sub=0;
        $total_31_40ans_sub=0;
        $total_41_50ans_sub=0;
        $total_50ans_sub=0;

        $total_femmes_autres=0;
        $total_hommes_autres=0;
        $total_15ans_autres=0;
        $total_15_17ans_autres=0;
        $total_18_30ans_autres=0;
        $total_31_40ans_autres=0;
        $total_41_50ans_autres=0;
        $total_50ans_autres=0;
           
        foreach($bilan_operation_mar as $b){
          $total_femmes_mar+=$b->nbre_femmes;
          $total_hommes_mar+=$b->nbre_hommes;

          $total_15ans_marocain+=$b->nbre_pers_15ans;
          $total_15_17ans_marocain+=$b->nbre_pers_15_17ans;
          $total_18_30ans_marocain+=$b->nbre_pers_18_30ans;
          $total_31_40ans_marocain+=$b->nbre_pers_31_40ans;
          $total_41_50ans_marocain+=$b->nbre_pers_41_50ans;
          $total_50ans_marocain+=$b->nbre_pers_50ans;
           
        }
        //dd($b->nbre_15ans);
        foreach($bilan_operation_sub as $b){
            $total_femmes_sub+=$b->nbre_femmes;
            $total_hommes_sub+=$b->nbre_hommes;
  
            $total_15ans_sub+=$b->nbre_pers_15ans;
            $total_15_17ans_sub+=$b->nbre_pers_15_17ans;
            $total_18_30ans_sub+=$b->nbre_pers_18_30ans;
            $total_31_40ans_sub+=$b->nbre_pers_31_40ans;
            $total_41_50ans_sub+=$b->nbre_pers_41_50ans;
            $total_50ans_sub+=$b->nbre_pers_50ans;
             
          }
          foreach($bilan_operation_autres as $b){
            $total_femmes_autres+=$b->nbre_femmes;
            $total_hommes_autres+=$b->nbre_hommes;
  
            $total_15ans_autres+=$b->nbre_pers_15ans;
            $total_15_17ans_autres+=$b->nbre_pers_15_17ans;
            $total_18_30ans_autres+=$b->nbre_pers_18_30ans;
            $total_31_40ans_autres+=$b->nbre_pers_31_40ans;
            $total_41_50ans_autres+=$b->nbre_pers_41_50ans;
            $total_50ans_autres+=$b->nbre_pers_50ans;
             
          }
          $data = [];
         
            
          //$data['bilan_operation'][] = $bilan_operation;
          $data['operation'][] = $operation;
          $data['date'][] = $date;
          $data['ville'][] = $ville;
          $data['total_femmes_mar'][] = $total_femmes_mar;
          $data['total_15ans_marocain'][] = $total_15ans_marocain;
          $data['total_15_17ans_marocain'][] = $total_15_17ans_marocain;
          $data['total_18_30ans_marocain'][] = $total_18_30ans_marocain;
          $data['total_hommes_mar'][] = $total_hommes_mar;
          $data['total_31_40ans_marocain'][] = $total_31_40ans_marocain;
  
          $data['total_41_50ans_marocain'][] = $total_41_50ans_marocain;
          $data['total_50ans_marocain'][] = $total_50ans_marocain;
          $data['total_femmes_sub'][] = $total_femmes_sub;
          $data['total_hommes_sub'][] = $total_hommes_sub;
          $data['total_15ans_sub'][] = $total_15ans_sub;
  
          $data['total_15_17ans_sub'][] = $total_15_17ans_sub;
          $data['total_18_30ans_sub'][] = $total_18_30ans_sub;
          $data['total_31_40ans_sub'][] = $total_31_40ans_sub;
          $data['total_41_50ans_sub'][] = $total_41_50ans_sub;
          $data['total_50ans_sub'][] = $total_50ans_sub;
  
          $data['total_femmes_autres'][] = $total_femmes_autres;
          $data['total_hommes_autres'][] = $total_hommes_autres;
          $data['total_15ans_autres'][] = $total_15ans_autres;
          $data['total_15_17ans_autres'][] = $total_15_17ans_autres;
          $data['total_18_30ans_autres'][] = $total_18_30ans_autres;
          
          $data['total_31_40ans_autres'][] = $total_31_40ans_autres;
          $data['total_41_50ans_autres'][] = $total_41_50ans_autres;
          $data['total_50ans_autres'][] = $total_50ans_autres;
          foreach($bilan_par_ville as $b){
              $data['labels_ville'][] = $b->ville;
              $data['total_par_ville'][] = $b->count;
          }
          foreach($bilan_par_pays_su as $b){
              $data['labels_pays_sub'][] = $b->region;
              $data['total_par_pays_sub'][] = $b->count;
          }
          foreach($bilan_par_pays_autres as $b){
              $data['labels_par_pays_autres'][] = $b->region;
              $data['total_par_pays_autres'][] = $b->count;
          }
          
         
     
          $data['chart_data'] = json_encode($data);
       return view('admin.recherche_bilan_annuel',compact(['data','bilan_operation','operation','date','ville'
    ,'total_femmes_mar','total_hommes_mar','total_15ans_marocain','total_15_17ans_marocain','total_18_30ans_marocain','total_31_40ans_marocain',
    'total_41_50ans_marocain','total_50ans_marocain','total_femmes_sub','total_hommes_sub','total_15ans_sub',
    'total_15_17ans_sub','total_18_30ans_sub','total_31_40ans_sub','total_41_50ans_sub','total_50ans_sub',
    'total_femmes_autres','total_hommes_autres','total_15ans_autres','total_15_17ans_autres','total_18_30ans_autres',
    'total_31_40ans_autres','total_41_50ans_autres','total_50ans_autres','bilan_par_ville','bilan_par_pays_su','bilan_par_pays_autres']));
    }
    public function getpref(Request $request){
        $region = $request->id;
        $pref = Pref::where('region',$region)
        ->get();
       // dd($pref);

        return response()->json($pref);
       
        
    }
    public function getville(Request $request){
        $pref = $request->id;
        $ville = Ville::where('pref',$pref)
        ->get();
        //dd($ville);

        return response()->json($ville);
       
        
    }

    public function ajout_stat_lieu(Request $request){
        $pref = Ville::where('ville',"$request->ville")->first();
        $region = Pref::where('pref',$pref->pref)->first();
        //dd($region);
        $ville = $request->ville;
        $quartier = $request->quartier;
        $nbre_personnes_lieu = $request->nbre_pers_lieu;
        $tranche_horaire = $request->tranche_horaire;
        $nationalite = $request->nationalite;
        $date = $request->date;
        $mois = explode('-',$date)[0].'-'.explode('-',$date)[1];
        
        //dd($mois);
        if($quartier=="NULL"){
            $quartier=" ";
        }
        $info = Prevalide::create([
            'region'=>"$region->region",
            'pref' => "$pref->pref",
            'ville' => "$ville",
            'quartier' => "$quartier",
            'nbre_pers_lieu' => $nbre_personnes_lieu,
            'tranche_horaire' => "$tranche_horaire",
            'nationalite' => "$nationalite",
            'jour' => "$date",
            'mois' => "$mois",
            'user'=>Session::get('user'),
            'traite'=>0,
        ]);
        if($info){
            $info_pre=Prevalide::where('user',Session::get('user'))->get();
        }
        return response()->json($info_pre);
       
        
    }
    public function ajout_pays_stat(Request $request){
        $region = $request->pays;
        $pref = null;
        $ville = null;
        $quartier = null;
        $nbre_personnes_lieu = $request->nbre_pers_lieu;
        $tranche_horaire = $request->tranche_horaire;
        $nationalite = $request->nationalite;
        $date = $request->date;
        $mois = $request->mois;
        //dd($request);
        $info = Prevalide::create([
            'region'=>"$region",
            'pref' => "$pref",
            'ville' => "$ville",
            'quartier' => "$quartier",
            'nbre_pers_lieu' => $nbre_personnes_lieu,
            'tranche_horaire' => "$tranche_horaire",
            'nationalite' => "$nationalite",
            'jour' => "$date",
            'mois' => "$mois",
            'user'=>Session::get('user'),
            'traite'=>0,
        ]);
        if($info){
            $info_pre=Prevalide::where('user',Session::get('user'))->get();
        }
        return response()->json($info_pre);
       
    }

    public function total_pers(Request $request){
        $femmes=$request->femmes;
        $hommes=$request->hommes;
        $total=$femmes+$hommes;
        return response()->json($total);}

    public function ajout_autocars(Request $request){
            $ville=$request->ville;
            $user=Session::get('user');
            $nbre_autocars=$request->nbre_autocars;
           
            $total=$request->total;
            $info = Prevalide::create([
                'region'=>"$ville",
                'pref' => "$nbre_autocars",
                'ville' => "$total",
                'quartier' => "0",
                'nbre_pers_lieu' => 0,
                'tranche_horaire' => "0",
                'nationalite' => "NULL",
                'jour' => "NULL",
                'mois' => "NULL",
                'user'=>$user,
                'traite'=>0,
            ]);
            //dd(Session::get('user'));
            if($info){
                $info_pre=Prevalide::where('user',Session::get('user'))->get();
            }
            return response()->json($info_pre);}

   
    public function form_assaut(){
        return view ('user.formulaire_assaut');
    }
    public function ajout_assaut(Request $request){
        $assaut=Assaut::create([
            'date'=>"$request->date_assaut",
            'nbre_assaut'=>"$request->nbre_assaut",
            'nbre_tentative_assaut'=>"$request->nbre_tent_assaut"
        ]);
        if($assaut){
            //Prevalide::where('user',Session::get('user'))->delete();
            return redirect()->back()->with('message', 'les informations sont bien ajoutées');
        }else{
            return back()->withErrors(['message'=>'Une erreur a étè introduite lors de l insertion des données!!!']);
        }
    }
    public function form_garde_esp(){
        return view ('user.intercepte_garde_espagnole');
    }
    public function ajout_garde_esp(Request $request){
        $assaut=Gespagnole::create([
            'date'=>"$request->date",
            'nbre_intercepte'=>"$request->nbre_pers"
        ]);
        if($assaut){
            //Prevalide::where('user',Session::get('user'))->delete();
            return redirect()->back()->with('message', 'les informations sont bien ajoutées');
        }else{
            return back()->withErrors(['message'=>'Une erreur a étè introduite lors de l insertion des données!!!']);
        }
    }

public function ajout_op_eloignement(Request $request){
                $prevalid=Prevalide::where('user',Session::get('user'))
                ->where('traite',0)
                ->get();
                $user=Session::get('user');
                //dd($prevalid);
                foreach($prevalid as $p){
                $bilan = Eloignement::create([
                    'date'=>"$request->date" ,
                    'ville'=>"$request->ville" ,
                    'nbre_mar'=> $request->marocains ,
                    'nbre_sub'=>$request->subsahariens ,
                    'nbre_autres'=>$request->autres_nationalités ,
                    'nbre_algeriens'=>$request->algeriens,
                    'ville_eloignement'=>"$p->region" ,
                    'total_ville'=>$p->ville ,
                    'nbre_sn'=>$request->total_sn,
                    'nbre_gr'=>$request->total_gr ,
                    'nbre_fa'=>$request->total_fa,
                    'user'=>Session::get('user')
                ]);}
                
                if($bilan){
                    Prevalide::where('user',Session::get('user'))->delete();
                    return redirect()->back()->with('message', 'les informations sont bien ajoutées');
                }else{
                    return back()->withErrors(['message'=>'Une erreur a étè introduite lors de l insertion des données!!!']);
                }}
                public function bilan_comparatif_sub(){
            //dd("hello");
                    $year=Eloignement::select(DB::raw("DATE_FORMAT(date, '%Y') year"))->groupBy('year')->get();
                    $tmp=$year->count()+1;
                    $month=['01','02','03','04','05','06','07','08','09','10','11','12'];
                    $date= DB::table('eloignements')
                    ->select('date')
                    ->distinct()
                    ->get();
                    //dd($date);
                    foreach($date as $d){
                        $operation= DB::table('eloignements')
                        ->select('nbre_sub')
                        ->where('date',$d->date)
                        ->first();
                        $data=explode("-",$d->date);
                        //dd($data[1]);
                        foreach($operation as $op){
                            
                            $tab[]=["$data[0]","$data[1]","$data[2]","$op"];
                            
                        }
                        //dd($tab);
                    }
                    //dd($tab);
                    
                    foreach($year as $y){
                        $cumuly=0;
                        //echo"year".$y->year ;
                        foreach($month as $m){
                            $cumul=0;
                            
                        foreach($tab as $t){
                            if($y->year==$t[0]){
                                //$cumuly=$cumuly+$t[3];
                                //echo' year '. $t[0] . ' cumul ' .$cumuly;
                                if($m==$t[1]){
                                    $cumul=$cumul+$t[3];
                                    //echo ' month '. $m . ' cumul ' .$cumul;
                                }
                            }  
                        }
                        $tab_final[]=["$y->year","$m","$cumul"];
                    }
                }
                        foreach($year as $y){
                            $cumuly=0;
                            foreach($tab_final as $t){
                                if($y->year==$t[0]){
                                    $cumuly=$cumuly+$t[2];
                                }
                                
                            }
                            $tabyear[]=["$y->year","$cumuly"];
                           
                        }
                        foreach($tab_final as $b){
                            $data['cumul'][] = $b[2];
                            $data['m'][] = $b[1];
                            $data['y']= $b[0];
                        }
                        $data['chart_data'] = json_encode($data);
                    return view("admin.bilan_comparatif_subsahariens",compact(['tab_final','tmp','year','month','tabyear','data']));
                   
                    
                
                    
                    
                }


                public function Bilan_annuel_assaut_eloi(){
                    //dd(hello)
                    $year=Eloignement::select(DB::raw("DATE_FORMAT(date, '%Y') year"))->groupBy('year')->get();
                    $tmp=$year->count()+1;
                    $month=['01','02','03','04','05','06','07','08','09','10','11','12'];
                    $date= DB::table('eloignements')
                    ->select('date')
                    ->distinct()
                    ->get();
                    //dd($date);
                    foreach($date as $d){
                        $operation= DB::table('eloignements')
                        ->select('nbre_sub','nbre_mar','nbre_autres')
                        ->where('date',$d->date)
                        ->first();
                        $data=explode("-",$d->date);
                        //echo($operation);
                        foreach($operation as $op){
                            echo($op);
                            $tab[]=["$data[0]","$data[1]","$data[2]","$op"];
                            
                        }
                        //dd($tab);
                    }
                    //dd($tab);
                    
                    foreach($year as $y){
                        $cumuly=0;
                        //echo"year".$y->year ;
                        foreach($month as $m){
                            $cumul=0;
                            
                        foreach($tab as $t){
                            if($y->year==$t[0]){
                                //$cumuly=$cumuly+$t[3];
                                //echo' year '. $t[0] . ' cumul ' .$cumuly;
                                if($m==$t[1]){
                                    $cumul=$cumul+$t[3];
                                    //echo ' month '. $m . ' cumul ' .$cumul;
                                }
                            }  
                        }
                        $tab_final[]=["$y->year","$m","$cumul"];
                    }
                }
                        foreach($year as $y){
                            $cumuly=0;
                            foreach($tab_final as $t){
                                if($y->year==$t[0]){
                                    $cumuly=$cumuly+$t[2];
                                }
                                
                            }
                            $tabyear[]=["$y->year","$cumuly"];
                           
                        }
                    
                }
                
            }

                




