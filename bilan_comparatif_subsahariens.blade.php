@extends('layouts.user_type.auth2')

@section('content')
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
                            <input type="number" class="form-control form-control-user" name="date_debut"/> - <input class="form-control form-control-user" type="number"name="date_fin"/>
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
<div class="container" >
                  <h1 style="font-size:30px">Bilan des operations d'eloignement: </h1>
                </div>
  
  
</fieldset>

<div class="card px-0 pt-0 pb-2">
  <div class="table-responsive p-0">
    <div style="font-family:Georgia; color:#000099; font-size:30px ; margin-top:1em; margin-right:1em;"><B>************1- Bilan comparatif Mensuel des subsahariens candidats à l'emigration clandestine eloignes: </B></div>
                
                     <table class="table table-striped">
                    
                     <tr> 
                        
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10" colspan="{{$tmp}}"  >   Annee </td> 
                        
                      </tr>
                      
                      <tr>
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"  width="10px"> Mois </td> 
                        <?php $p=0?>
                        @foreach($year as $y)
                        <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10"> {{$y->year}} </td>
                        @endforeach
                      </tr>
                @foreach ($month as $m )
                    
                <tr>
                    <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">{{$m}}</td>
                       
                  @foreach($tab_final as $t)
                      @if($t[1]==$m)
                     <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">{{$t[2]}}</td>
                         @endif
                  @endforeach
                  
                </tr>
                
                  @endforeach   
                      
                  <tr>
                    <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total</td>
                    @foreach($tabyear as $t)
                     <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">{{$t[1]}}</td>
                       
                  @endforeach
                </tr>  
                    
                     </table>
                     
                              </div>
                              </div>
                              </div>

                  @push('dashboard')
                   <script>
                   
                     $(function(){
                         //get the pie chart canvas
                         var cData = JSON.parse(`<?php echo $data['chart_data']; ?>`);
                         var ctx = $("#bar");
                         //pie chart data
                         var data = {
                           labels: ['Janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre'],
                           datasets: [
                            {
                               data: [cData.cumul],
                               backgroundColor: [
                                 "#6666ff",
                                 "#0000cc"
                               ],
                               
                               borderWidth: [1]
                             }
                           ]
                         };
                         var options = {
                           responsive: true,
                           title: {
                             display: true,
                             position: "top",
                             text: " ",
                             fontSize: 18,
                             fontColor: "#111"
                           },
                           legend: {
                             display: true,
                             position: "bottom",
                             labels: {
                               fontColor: "#333",
                               fontSize: 16
                             }
                           }
                         };
                         //create Pie Chart class object
                         var chart = new Chart(ctx, {
                           type: "pie",
                           data: data,
                           options: options
                         });})
                   </script>
                   @endpush            
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


                            


                                  <a href='{{route("bilan.eloignement.pdf")}}'  class="btn btn-primary btn-block"  > Telecharger le bilan format PDF</a>
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




