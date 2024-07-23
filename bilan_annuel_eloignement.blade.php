@extends('layouts.user_type.auth2')

@section('content')


&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;
&#160;



<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
   <div class="container-fluid py-4">
     <div class="row">
       <div class="col-12">
         <div class="card mb-4">
           <div class="card-header pb-0">
             <h1 style="font-size:30px">Bilan des operations d'eloignement des candidats à l'immigration clandestine</h1>
           </div>
           <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
             <fieldset class="border p-2">
               <legend  class="w-auto">    </legend><BR>
                  <form class="d-flex" action="" method="GET">
                    <table align="center" >
                      <TR >
                       <TD >
                         <label>date</label>
                        </TD>
                        <TD style="width: 500px;">
                            <input type="date" class="form-control form-control-user" name="date_debut"/> - <input class="form-control form-control-user" type="date"name="date_fin"/>
                        </TD>
                      </TR>
                      <TR>
                        <TD colspan="6">
                          <div align="center"> <button class="btn btn-success" type="submit">chercher</button></div></TD>
                       </TR>
                   </table>  
                  </form>
             </fieldset>
            </div>
           </div>
         </div>
       </div>
     </div>
   </div>
</main>
<fieldset class="card" style="text-align: center">
  @if($date_fin)
    <p style="font-family:Georgia;"><span style="color:#000000;">Periode Du : </span>{{$date_debut}} Au : </span>{{$date_fin}} </p>
  @else
  <p style="font-family:Georgia;"><span style="color:#000000;">Date : </span>{{$date_debut}}</p>
  @endif
</fieldset>
<div class="card-body px-0 pt-0 pb-2">
  <div class="table-responsive p-0">
    <div style="font-family:Georgia; color:#000099; font-size:30px ; margin-top:1em; margin-right:1em;"><B>1- Bilan des candidats eloignés par categorie: </B></div>
                <table><tr><td>
                     <table class="table table-striped">
                      <tr> 
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10" rowspan="2" style="font-size:10px; width:8%"> Date</td> 
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10" colspan="4" style="font-size:10px; width:8%"> TOTAL ELOIGNE DES CANDIDATS PAR CATEGORIE  </td> 
                        
                    </tr>
                    
           
                      
                      <tr>
                        
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> Subsahariens</td>
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">marocains</td>
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">autres nationalites</td>
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">total eloigne</td>
                      
                       </tr>
                      
                      @foreach ($date_tab as $p)
                        <tr>
                          <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> {{$total_ville[$p][0]->date}}</td>
                          <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> {{$total_ville[$p][0]->count_sub}}</td>
                          <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">{{$total_ville[$p][0]->count_mar}}</td>
                          <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">{{$total_ville[$p][0]->count_autres}}</td>
                          <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"><?php $totale=$total_ville[$p][0]->count_sub+$total_ville[$p][0]->count_mar+$total_ville[$p][0]->count_autres;echo($totale);?></td>
                         @endforeach

                     </table>
                    </td>
                  <td>
                    <table class="table table-striped">
                      <tr>  
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10" colspan="4" style="font-size:10px; width:8%" > NBR autocars </td> 
                        
                    </tr>
                    
           
                    <tr>
                    @foreach ($date_tab as $p)
                    @foreach ($total_ville["$p"] as $d )
                    <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> {{$d->ville_eloignement}}</td>
                    @endforeach
                    @endforeach
                    </tr>
                    <tr>
                      @foreach ($date_tab as $p)
                      @foreach ($total_ville["$p"] as $d )
                      <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> {{$d->ville_eloignement}}</td>
                      @endforeach
                      @endforeach
                      </tr>
                      
                     </table>
                  </td>
                  </tr>
                </table>
                              </div>
                              </div>
                             </div>

<div class="card-body px-0 pt-0 pb-2">
<div class="table-responsive p-0">
  <div style="font-family:Georgia; color:#000099; font-size:30px ; margin-top:1em; margin-right:2em;"><B>2- Bilan des autocars: </B></div>
              
                    <table class="table table-striped">
                    <tr> 
                      <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> Date</td> 
                      <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> Ville</td> 
                      <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> total</td> 
                    </tr>
                    @foreach($date_tab as $d)
                    
                    <tr>
                      <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10" rowspan='{{$total_ville["$d"]->count()}}'> {{$d}}</td>
                      @foreach($total_ville["$d"] as $t)
                      <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> {{$t->ville_eloignement}}</td>
                      <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">{{$t->count}}</td></tr>
                      @endforeach

                    @endforeach
                    </table>
                            </div>
                            </div>
                            </div>

<div class="card-body px-0 pt-0 pb-2">
  <div class="table-responsive p-0">
    <div style="font-family:Georgia; color:#000099; font-size:30px ; margin-top:1em; margin-right:2em;"><B>3- Effectifs deploye : </B></div>
                
                      <table class="table table-striped">
                        <table class="table table-striped">
                          <tr> 
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10" rowspan="2"> Date</td> 
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10" colspan="4" > EFFECTIF DEPLOYE EN MOYENNE </td> 
                            
                          </tr>
                          
                          <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> G.R</td>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">S.N</td>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">F.A</td>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">total </td>
                            
                          </tr>
                          @foreach ($period as $p)
                            @foreach ($data as $d )
                            @if($d->date==$p->format('Y-m-d'))
                            <tr>
                              <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> {{$d->date}}</td>
                              <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> {{$d->nbre_gr}}</td>
                              <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">{{$d->nbre_sn}}</td>
                              <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">{{$d->nbre_fa}}</td>
                              <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"><?php $totale=$d->nbre_gr+$d->nbre_sn+$d->nbre_fa;echo($totale);?></td>
                            </tr>
                              @break
                                @endif
                            @endforeach
                          @endforeach
                         </table>
                                  </div>
                                  </div>
                                  </div>
                                  <a href='{{route("bilan.eloignement.pdf")}}'  class="btn btn-primary btn-block" > Telecharger le bilan format PDF</a></td>
                              </div>
                              </div>
                              </div>
                              </div>
                              </div>
                              </div>
                           </main>
                   
                   
                   @endsection
                   @push('dashboard')
                   <script>
                   
                     
                   
                     
                     </script>
                     
                     
                   @endpush




