
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <section class="content-articles">
                <div class="content-articles-heading">
                    <h3>Dashboard Kelas Online</h3>
                </div>
            </section>
        
        <div class="container content-dashboard-kelas-online">
            
            <div class="row">
               
                <div class="card">
                    <div class="card-header">
                        <h3>Daftar Member Course</h3>
                    </div>
                    <div class="card-block">
                        
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="20">No</th>
                                        <th>Nama</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($coursemember as $key => $value): ?>
                                    <tr>
                                        <td class="tdID" user-id="<?php echo $value->user->id ?>"><?php echo $no ?></td>
                                        <td class="name-user"><?php echo $value->user->first_name." ".$value->user->last_name ?></td>
                                    	<td>
                                    		<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary btn-lg btn-view" data-toggle="modal" data-target="#myModal">
											  Lihat Skor Exam
											</button>
                                    	</td>
                                    </tr>                                    
                                    <?php $no++; endforeach ?>
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Skor Exam <span class="title-name-user"></span></h4>
      </div>
      <div class="modal-body">
        	<div class="response-data"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
    </div>
  </div>
</div>

<?php custom_script() ?>
<script type="text/javascript">
    var scores=function(){

         var url = "<?php echo site_url('dashboard/course/getexamscores') ?>";
        
        return{
            init:function(){
                scores.setData();
                
            },
            setData:function(){
                
               
                $('.btn-view').click(function(){
                   
                    var userid = $(this).closest("tr").find(".tdID").attr('user-id');
                    var username = $(this).closest("tr").find(".name-user").text();

                   	$('.title-name-user').html(username);

                    $.ajax({
                        type: "GET",
                        url: url+'/'+userid,
                        success: function(response){
                            
                            $('.response-data').html(response);

                        }
                    });
                });
               
            },
            
            
        } 
        }();
        scores.init();


 </script>

 <?php endcustom_script() ?>