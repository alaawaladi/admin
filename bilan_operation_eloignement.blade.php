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



<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg " style="margin-bottom:20em">
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
                  <form class="d-flex" action="{{route('bilan.operation.recherche')}}" method="GET">
                    <table align="center" >
                      <TR >
                       <TD >
                         <label>date</label>
                        </TD>
                        <TD style="width: 500px;">
                            <input type="date"name="date_debut" class="form-control form-control-user"/> </td><td >-</td><td style="width: 500px;"> <input type="date"name="date_fin" class="form-control form-control-user"/>
                        </TD>
                            
                        
                     
                      </TR>
                     
                  
              <TR>
                <TD colspan="6">
                  <div align="center"> <button class="btn btn-success" type="submit">chercher</button></div></TD>
              </TR>
                   </table>  
                  </form>
                             
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
                   
                     
                      
                     
                     </script>
                     
                     
                   @endpush