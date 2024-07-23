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
             <h1 style="font-size:30px">Opération de lutte contre l'émigration clandestine: bilan realisé par année</h1>
           </div>
           <div class="card-body px-0 pt-0 pb-2">
             <div class="table-responsive p-0">
                <fieldset class="border p-2">
                    <legend  class="w-auto">    </legend><BR>
                       <form class="d-flex" action="{{route('bilan.annee')}}" method="GET">
                         <table align="center" >
                           <TR >
                            <TD >
                              <label>type d'operation</label>
                                   </TD>
                                   <TD style="width: 500px;"><select id="operation" name="operation" class="form-control form-control-user" required>
                                    <option >---Selectionner l'operation---</option>
                                    <option value="Dispositif Permanent(6éme BSF/FAR-35éme GMM/FA-Marine Royale)">Dispositif Permanent(6éme BSF/FAR-35éme GMM/FA-Marine Royale)</option>
                                    <option value="Dispositif de ratissage (AL/POLICE/GR/FA)">Dispositif de ratissage (AL/POLICE/GR/FA)</option>
                                    

                                 </TD>
                                 <TD>
                                    <label>ville</label></TD> 
                                    <TD style="width: 500px;"><select id="ville" name="ville" class="form-control form-control-user" required>
                                      <option >---Selectionner la ville---</option>
                                      <option value="mdiq">M'diq</option>
                                      <option value="fnideq">Fnideq</option>
                                      <option value="martil">Martil</option>
                                      <option value="bellyounech">Bellyounech</option>
                                      <option value="alliyenne">Alliyenne</option></select></TD> 
                          
                           </TR>
                           <tr>
                            <TD >
                            <label>Année</label>
                            </TD>
                            <TD style="width: 500px;">
                                <?php $years = range(1900, strftime("%Y", time())); ?>
                                
                                <select name="date" class="form-control form-control-user">
                                  <option>----</option>
                                  <?php foreach($years as $year) : ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                  <?php endforeach; ?>
                            </TD>
                       </tr>
                   <TR>
                     <TD colspan="6">
                       <div align="center"> <button class="btn btn-success" type="submit">chercher</button></div></TD>
                   </TR>
                        </table>  
                       </form>
                   </fieldset>
           
                   <fieldset class="card" style="text-align: center">
                        <p style="font-family:Georgia; color:#ff0000; font-size:30px"><i> {{$operation}}</i> </p>
                        <p style="font-family:Georgia;"><span style="color:#000000;">Année : </span>{{$date}} </p>
                        <p style="font-family:Georgia;"><span style="color:#000000;">Ville : </span>{{$ville}}</p>
                   </fieldset>
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
                   <div class="card">
                    @if($total_femmes_mar||$total_15ans_marocain||$total_15_17ans_marocain||$total_18_30ans_marocain||$total_31_40ans_marocain||$total_41_50ans_marocain||$total_50ans_marocain
                    ||$bilan_par_ville->count()>0)
                    <div style="font-family:Georgia; color:#000099; font-size:30px ; margin-top:1em; margin-right:1em;"><B>1- Catégorie des C.E.C de nationalité marocaine : </B></div>
                    
                      <h4 style="color: #006600"> Bilan par genre</h4>
                      @if($total_femmes_mar||$total_hommes_mar)
                      <table style="width:100%">
                        <tr>
                          <td style="width:50%">
                      <table class="table table-striped">
                              <tbody>
                                <tr><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des Femmes</td><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des hommes</td></tr>
                                <tr><td align="center">{{$total_femmes_mar}}</td><td align="center">{{$total_hommes_mar}}</td>
                                </tbody>
                            </table>
                          </td>
                          <td >
                            <div >
                                  <div>
                                      <canvas id="bar"></div>
                                  </div>	
                            </div>
                          </td>
                        </tr>
                      </table>
                      @endif
                        <h4 style="color: #006600">Bilan par tranche d'âge</h4>
                        @if($total_15ans_marocain||$total_15_17ans_marocain||$total_18_30ans_marocain||$total_31_40ans_marocain||$total_41_50ans_marocain||$total_50ans_marocain)
                        <table style="width:100%">
                          <tr>
                            <td style="width:50%">
                        <table class="table table-striped">
                            <tr>
                                <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Tranche d'âge</td>
                                <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">nbre de personnes</td>
                                
                            </tr>
                            <tr>
                                <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">< 15ans</td>
                                <td align="center">{{$total_15ans_marocain}}</td>
                            </tr>
                            <tr>
                                <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">15-17ans </td>
                                <td align="center">{{$total_15_17ans_marocain}} </td>
                            </tr>
                            <tr>
                                <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">18-30ans </td>
                                <td align="center">{{$total_18_30ans_marocain}}</td>
                            </tr>
                            <tr>
                                <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">31-40ans </td>
                                <td align="center">{{$total_31_40ans_marocain}}</td>
                            </tr>
                            <tr>
                                <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">41-50ans </td>
                                <td align="center">{{$total_41_50ans_marocain}} </td>
                            </tr>
                            <tr>
                                <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">>50ans </td>
                                <td align="center">{{$total_50ans_marocain}}</td>
                            </tr>
                        </table>
                        
                      </td>
                        <td style="width:50%">
                          <div class="col-md-12">
                                <div class="card-body">
                                    <canvas id="bar1"></div>
                                </div>	
                          </div>
                        </td>
                      </tr>
                    </table>
                    @endif
                    <table style="width:100%">
                      <tr>
                        <td style="width:50%">
                        <h4 style="color: #006600"> Bilan par lieu de provenance</h4>
                        @if($bilan_par_ville->count()>0)
                        <table class="table table-striped">
                          <tbody>
                            <tr><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">ville</td><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des personnes interceptes</td></tr>
                            
                            @foreach ($bilan_par_ville as $b )
                            <tr><td align="center">{{$b->ville}}</td><td align="center">{{$b->count}}</td>
                            @endforeach
                            
                            </tbody>
                        </table>
                        
                      </td>
                      <td style="width:50%">
                        <div class="col-md-12">
                              <div class="card-body">
                                  <canvas id="bar2"></div>
                              </div>	
                        </div>
                      </td>
                    </tr>
                  </table>
                  @endif
                  </div>
                  
                  &#160;
                  &#160;
                  &#160;
                  &#160;
                  &#160;
                  &#160;
                  &#160;
                  &#160;
                  @endif
                  <div class="card">
                    @if($total_femmes_sub||$total_hommes_sub||$total_15ans_sub||$total_15_17ans_sub||$total_18_30ans_sub||$total_31_40ans_sub||$total_41_50ans_sub
                    ||$bilan_par_pays_su->count()>0)
                  <div style="font-family:Georgia; color:#000099; font-size:30px"><B>2- Catégorie des C.E.C d'origine subsaharienne: </B></div>
                   <h4 style="color: #006600"> Bilan par genre</h4>
                   @if($total_femmes_sub||$total_hommes_sub)
                   <table style="width:100%">
                    <tr>
                      <td style="width:50%">
                   <table class="table table-striped" >
                      <tbody>
                        <tr><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des Femmes</td><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des hommes</td></tr>
                        <tr><td align="center">{{$total_femmes_sub}}</td><td align="center">{{$total_hommes_sub}}</td>
                        </tbody>
                    </table>
                  </td>
                  <td style="width:50%">
                    <div class="col-md-12">
                      <div class="card-body">
                          <canvas id="bar3"></div>
                      </div>	
                  </div>
                  </td>
                  </tr>
                  </table>
                  @endif
                  
                  <table style="width:100%">
                  <tr>
                  <td style="width:50%">
                    <h4 style="color: #006600">Bilan par tranche d'âge</h4>
                    @if($total_15ans_sub||$total_15_17ans_sub||$total_18_30ans_sub||$total_31_40ans_sub||$total_41_50ans_sub)
                    <table class="table table-striped">
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Tranche d'âge</td>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">nbre de personnes</td>
                            
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">< 15ans </td>
                            <td align="center">{{$total_15ans_sub}}</td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">15-17ans</td>
                            <td align="center">{{$total_15_17ans_sub}} </td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">18-30ans</td>
                            <td align="center">{{$total_18_30ans_sub}}</td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">31-40ans</td>
                            <td align="center">{{$total_31_40ans_sub}}</td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">41-50ans</td>
                            <td align="center">{{$total_41_50ans_sub}} </td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">>50ans</td>
                            <td align="center">{{$total_50ans_sub}}</td>
                        </tr>
                    </table>
                    <td style="width:50%">
                      <div class="col-md-12">
                        <div class="card-body">
                            <canvas id="bar4"></div>
                        </div>	
                  </div>
                    </td>
                  </tr>
                  </table>
                  @endif
                  
                  <table style="width:100%">
                  <tr>
                    <td style="width:50%">
                    <h4 style="color: #006600"> Bilan par lieu de provenance</h4>
                    @if($bilan_par_pays_su->count()>0)
                    <table class="table table-striped">
                       <tbody>
                         <tr><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">ville</td><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des personnes interceptes</td></tr>
                         
                         @foreach ($bilan_par_pays_su as $b )
                         <tr><td align="center">{{$b->region}}</td><td align="center">{{$b->count}}</td>
                         @endforeach
                         </tbody>
                     </table>
                     <td style="width:50%">
                      <div class="col-md-12">
                        <div class="card-body">
                            <canvas id="bar5"></div>
                        </div>	
                  </div>
                    </td>
                  </tr>
                  </table>
                  @endif
                  </div>
                  &#160;
                  &#160;
                  &#160;
                  &#160;
                  &#160;&#160;
                  &#160;
                  &#160;
                  &#160;
                  @endif
                  <div class="card">
                    @if($total_femmes_autres||$total_hommes_autres||$total_15ans_autres||$total_15_17ans_autres||$total_18_30ans_autres||$total_31_40ans_autres||$total_41_50ans_autres
                    ||$bilan_par_pays_autres->count()>0)
                  <div style="font-family:Georgia; color:#000099; font-size:30px"><B>3- Categorie des C.E.C d'autres nationalités: </B></div>
                   <h4 style="color: #006600"> Bilan par genre</h4>
                   @if($total_femmes_autres||$total_hommes_autres)
                   <table style="width:100%">
                    <tr>
                      <td style="width:50%">
                   <table class="table table-striped">
                      <tbody>
                        <tr><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des Femmes</td><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des hommes</td></tr>
                        <tr><td align="center">{{$total_femmes_autres}}</td><td align="center">{{$total_hommes_autres}}</td>
                        </tbody>
                    </table>
                    <td >
                      <div >
                        <div >
                            <canvas id="bar6"> hello</div>
                        </div>	
                  </div>
                    </td>
                  </tr>
                  </table>
                  @endif
                  <table style="width:100%">
                  <tr>
                    <td style="width:50%">
                    <h4 style="color: #006600">Bilan par tranche d'âge</h4>
                    @if($total_hommes_autres||$total_15ans_autres||$total_15_17ans_autres||$total_18_30ans_autres||$total_31_40ans_autres||$total_41_50ans_autres)
                    <table class="table table-striped">
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Tranche d'âge</td>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">nbre de personnes</td>
                            
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">< 15ans</td>
                            <td align="center">{{$total_15ans_autres}}</td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">15-17ans</td>
                            <td align="center">{{$total_15_17ans_autres}} </td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">18-30ans</td>
                            <td align="center">{{$total_18_30ans_autres}}</td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">31-40ans</td>
                            <td align="center">{{$total_31_40ans_autres}}</td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">41-50ans</td>
                            <td align="center">{{$total_41_50ans_autres}} </td>
                        </tr>
                        <tr>
                            <td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">>50ans</td>
                            <td align="center">{{$total_50ans_autres}}</td>
                        </tr>
                    </table>
                    <td style="width:50%">
                      <div class="col-md-12">
                        <div class="card-body">
                            <canvas id="bar7"></div>
                        </div>	
                  </div>
                    </td>
                  </tr>
                  </table>
                  @endif
                    <table style="width:100%">
                      <tr>
                        <td style="width:50%">
                    <h4 style="color: #006600"> Bilan par lieu de provenance</h4>
                    @if($bilan_par_pays_autres->count()>0)
                    <table class="table table-striped">
                       <tbody>
                         <tr><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">ville</td><td align="center" class="text-uppercase text-secondary text-xl font-weight-bolder opacity-10">Total des personnes interceptes</td></tr>
                         
                         @foreach ($bilan_par_pays_autres as $b )
                         <tr><td align="center">{{$b->region}}</td><td align="center">{{$b->count}}</td>
                         @endforeach
                         
                         </tbody>
                     </table>
                     <td style="width:50%">
                      <div class="col-md-12">
                        <div class="card-body">
                            <canvas id="bar8"></div>
                        </div>	
                  </div>
                    </td>
                  </tr>
                  </table>
                  @endif
                  @endif
                                    <a href='{{route("bilan.annee.pdf")}}'  class="btn btn-primary btn-block" > Telecharger le bilan format PDF</a></td>
                                                       
                              </div>
                              </div>
                              </div>
                              </div>
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
                   
                     $(function(){
                         //get the pie chart canvas
                         var cData = JSON.parse(`<?php echo $data['chart_data']; ?>`);
                         var ctx = $("#bar");
                         //pie chart data
                         var data = {
                           labels: ['Femmes','Hommes'],
                           datasets: [
                            {
                               data: [cData.total_femmes_mar,cData.total_hommes_mar],
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
                         });
                   
                         var ctx6 = $("#bar6");
                         //pie chart data
                         var data6 = {
                           labels: ['Femmes','Hommes'],
                           datasets: [
                            {
                               data: [cData.total_femmes_autres,cData.total_hommes_autres],
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
                         var chart6 = new Chart(ctx6, {
                           type: "pie",
                           data: data6,
                           options: options
                         });
                         var ctx3 = $("#bar3");
                         //pie chart data
                         var data3 = {
                           labels: ['Femmes','Hommes'],
                           datasets: [
                            {
                              data: [cData.total_femmes_sub,cData.total_hommes_sub],
                               backgroundColor: [
                                 "#6666ff",
                                 "#0000cc"
                               ],
                               
                               borderWidth: [1]
                             }
                           ]
                         };
                     
                         //create Pie Chart class object
                         var chart3 = new Chart(ctx3, {
                           type: "pie",
                           data: data3,
                           options: options
                         });
                         
                     var ctx2 = $("#bar2");
                         //pie chart data
                         var data2 = {
                           labels: cData.labels_ville,
                           datasets: [
                            {
                               data:cData.total_par_ville,
                                backgroundColor: [
                                 "#006600",
                                 "#33cc33",
                                 "#79d279",
                                 "#00b300",
                                 "#990000",
                                 "#cc6600",
                                 "#e6f7ff",
                                 "#cceeff",
                                 "#b3e6ff",
                                 "#99ddff",
                                "#80d4ff",
                                 "#66ccff",
                                 "#4dc3ff",
                                 "#33bbff",
                                 "#1ab2ff",
                                 "#00aaff",
                                 "#0099e6",
                                 "#0088cc", 		
                                 "#0077b3"
                               ],
                               
                               borderWidth: [1]
                             }
                             
                             
                           ]
                         };
                     
                     
                         //create Pie Chart class object
                         var chart2 = new Chart(ctx2, {
                           type: "pie",
                           data: data2,
                           options: options
                         });
                   
                   
                         var ctx5 = $("#bar5");
                         //pie chart data
                         var data5 = {
                           labels: cData.labels_pays_sub,
                           datasets: [
                            {
                               data:cData.total_par_pays_sub,
                                backgroundColor: [
                                 "#006600",
                                 "#33cc33",
                                 "#79d279",
                                 "#00b300",
                                 "#990000",
                                 "#cc6600",
                                 "#e6f7ff",
                                 "#cceeff",
                                 "#b3e6ff",
                                 "#99ddff",
                                "#80d4ff",
                                 "#66ccff",
                                 "#4dc3ff",
                                 "#33bbff",
                                 "#1ab2ff",
                                 "#00aaff",
                                 "#0099e6",
                                 "#0088cc", 		
                                 "#0077b3"
                               ],
                               
                               borderWidth: [1]
                             }
                             
                             
                           ]
                         };
                     
                     
                         //create Pie Chart class object
                         var chart2 = new Chart(ctx5, {
                           type: "pie",
                           data: data5,
                           options: options
                         });
                   
                   
                         var ctx8 = $("#bar8");
                         //pie chart data
                         var data8 = {
                           labels: cData.labels_pays_autres,
                           datasets: [
                            {
                               data:cData.total_par_pays_autres,
                                backgroundColor: [
                                 "#006600",
                                 "#33cc33",
                                 "#79d279",
                                 "#00b300",
                                 "#990000",
                                 "#cc6600",
                                 "#e6f7ff",
                                 "#cceeff",
                                 "#b3e6ff",
                                 "#99ddff",
                                "#80d4ff",
                                 "#66ccff",
                                 "#4dc3ff",
                                 "#33bbff",
                                 "#1ab2ff",
                                 "#00aaff",
                                 "#0099e6",
                                 "#0088cc", 		
                                 "#0077b3"
                               ],
                               
                               borderWidth: [1]
                             }
                             
                             
                           ]
                         };
                     
                     
                         //create Pie Chart class object
                         var chart8 = new Chart(ctx8, {
                           type: "pie",
                           data: data8,
                           options: options
                         });
                         var ctx1 = $("#bar1");
                         //pie chart data
                         var data1 = {
                           labels: ['<15ans','15-17ans','18-30ans','31-40ans','41-50ans','>50ans'],
                           datasets: [
                            {
                               data: [cData.total_15ans_marocain,cData.total_15_17ans_marocain,cData.total_18_30ans_marocain,cData.total_31_40ans_marocain,cData.total_41_50ans_marocain,cData.total_50ans_marocain],
                               backgroundColor: [
                                 "#663300",
                                 "#996600",
                                 "cc3300",
                                 "#993300",
                                 "#990000",
                                 "#cc6600"
                               ],
                               
                               borderWidth: [1]
                             }
                             
                             
                           ]
                         };
                     
                     
                         //create Pie Chart class object
                         var chart = new Chart(ctx1, {
                           type: "pie",
                           data: data1,
                           options: options
                         });
                         
                         
                   
                         
                         var ctx4 = $("#bar4");
                         //pie chart data
                         var data4 = {
                           labels: ['<15ans','15-17ans','18-30ans','31-40ans','41-50ans','>50ans'],
                           datasets: [
                            {
                               data: [cData.total_15ans_sub,cData.total_15_17ans_sub,cData.total_18_30ans_sub,cData.total_31_40ans_sub,cData.total_41_50ans_sub,cData.total_50ans_sub],
                               backgroundColor: [
                                 "#663300",
                                 "#996600",
                                 "cc3300",
                                 "#993300",
                                 "#990000",
                                 "#cc6600"
                               ],
                               
                               borderWidth: [1]
                             }
                             
                             
                           ]
                         };
                     
                     
                         //create Pie Chart class object
                         var chart = new Chart(ctx4, {
                           type: "pie",
                           data: data4,
                           options: options
                         });
                         
                   
                         var ctx7 = $("#bar7");
                         //pie chart data
                         var data7 = {
                           labels: ['<15ans','15-17ans','18-30ans','31-40ans','41-50ans','>50ans'],
                           datasets: [
                            {
                               data: [cData.total_15ans_autres,cData.total_15_17ans_autres,cData.total_18_30ans_autres,cData.total_31_40ans_autres,cData.total_41_50ans_autres,cData.total_50ans_autres],
                               backgroundColor: [
                                 "#663300",
                                 "#996600",
                                 "cc3300",
                                 "#993300",
                                 "#990000",
                                 "#cc6600"
                               ],
                               
                               borderWidth: [1]
                             }
                             
                             
                           ]
                         };
                     
                     
                         //create Pie Chart class object
                         var chart7 = new Chart(ctx7, {
                           type: "pie",
                           data: data7,
                           options: options
                         });
                         
                     
                     });
                   
                     
                     </script>
                     
                     
                   @endpush




