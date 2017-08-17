
<div class="col-md-12 col-sm-12" ng-app="firstapp" ng-controller="Index">
	
<div class="panel panel-default">
	<div class="panel-body">



<form class="form-inline">
<div class="form-group">
<button class="btn btn-primary" ng-click="Modaladd()">+เพิ่มไฟล์</button>
</div>
<div class="form-group">
<input type="text" ng-model="searchtext" class="form-control" placeholder="ค้นหา" style="width: 300px;">
</div>
<div class="form-group">
<button type="submit" ng-click="getlist(searchtext,'1')" class="btn btn-success" placeholder="" title="ค้นหา"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</div>
<div class="form-group">
<button type="submit" ng-click="getlist('','1')" class="btn btn-default" placeholder="" title="รีเฟรส"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
</div>

</form>


<div style="float: right;">
	<input type="checkbox" ng-model="showdeletcbut"> แสดงปุ่มลบ
</div>
<table id="headerTable" class="table table-hover table-bordered">
	<thead>
		<tr style="background-color: #eee;">
			<th style="text-align: center;width: 50px;">ลำดับ</th>
			<th style="text-align: center;width: 50px;">ดาวน์โหลด</th>
			<th style="text-align: center;width: 100px;">ชื่อไฟล์</th>
			<th style="text-align: center;width: 150px;">รายละเอียด</th>
			<th style="text-align: center;width: 50px;">ประเภท</th>
			<th style="text-align: center;width: 50px;">ขนาด(MB)</th>
			<th style="text-align: center;width: 150px;">วันที่</th>
			
			<th style="width: 80px;">จัดการ</th>
		</tr>
	</thead>
	<tbody>
	



		<tr ng-repeat="x in list">
		<td ng-if="selectpage=='1'" class="text-center">{{($index+1)}}</td>
		<td ng-if="selectpage!='1'" class="text-center">{{($index+1)+(perpage*(selectpage-1))}}</td>

<td align="center"><a href="<?=$base_url?>/{{x.file}}" download>
	<span class="glyphicon glyphicon-download" aria-hidden="true" style="font-size: 20px;"></span>
</a></td>

<td>{{x.title}}</td>	
<td>{{x.des}}</td>

<td align="center">{{x.type}}</td>
<td align="right">{{x.size/1000000 | number}}</td>
<td align="right">{{x.create_date}}</td>
			
			
<td>
				<button class="btn btn-xs btn-warning" ng-click="Editinputproduct(x)">แก้ไข</button>
				<button ng-show="showdeletcbut" class="btn btn-xs btn-danger" ng-click="Deleteproduct(x)">ลบ</button>
			</td>

		

		</tr>
	</tbody>
</table>







<form class="form-inline">

<hr />

<div class="form-group">
แสดง
<select class="form-control" name="" id="" ng-model="perpage" ng-change="getlist(searchtext,'1',perpage)">
	<option value="10">10</option>
	<option value="20">20</option>
	<option value="30">30</option>
	<option value="50">50</option>
	<option value="100">100</option>
	<option value="200">200</option>
	<option value="300">300</option>
</select>

หน้า
<select name="" id="" class="form-control" ng-model="selectthispage"  ng-change="getlist(searchtext,selectthispage,perpage)">
	<option  ng-repeat="i in pagealladd" value="{{i.a}}">{{i.a}}</option>
</select>
</div>


</form>









<div class="modal fade" id="Openadd">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">เพิ่มไฟล์</h4>
			</div>
			<div class="modal-body">
				<form id="uploadImg"  enctype="multipart/form-data" method="POST">

ชื่อไฟล์
<input type="text" name="title"  placeholder="ชื่อไฟล์" class="form-control">
<p></p>
เลือกไฟล์
<input type="file" name="file" accept="" class="form-control" value="">
<p></p>
รายละเอียด
<textarea type="text" name="des"  placeholder="รายละเอียด" class="form-control">
</textarea>

<p></p>


<button class="btn btn-success" id="savefile" type="submit">บันทึก</button>
</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>





<div class="modal fade" id="Openedit">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">แก้ไข</h4>
			</div>
			<div class="modal-body">
				<form id="Updatedata"  enctype="multipart/form-data" method="POST">
<input type="hidden" name="id" id="id"  placeholder="id" class="form-control">
ชื่อไฟล์
<input type="text" name="title" id="title"  placeholder="ชื่อไฟล์" class="form-control">
<p></p>
รายละเอียด
<textarea type="text" name="des" id="des"  placeholder="รายละเอียด" class="form-control"></textarea>

<p></p>


<button class="btn btn-success" type="submit">บันทึก</button>
</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>











	</div>


	</div>

	</div>


	<script>
var app = angular.module('firstapp', []);
app.controller('Index', function($scope,$http,$location) {


$scope.productlist = [];


$scope.Modaladd = function(){
$('#Openadd').modal('show');
};





$scope.perpage = '10';
$scope.getlist = function(searchtext,page,perpage){
    if(!searchtext){
   	searchtext = '';
   	$scope.searchtext = '';
   }


    if(!page){
   var	page = '1';
   }

 if(!perpage){
   var	perpage = '10';
   }

 $http.post("Doc/get",{
searchtext:searchtext,
page: page,
perpage: perpage
}).success(function(data){
          $scope.list = data.list; 
                 $scope.pageall = data.pageall;
$scope.numall = data.numall;

$scope.pagealladd = [];
           for(i=1;i<=$scope.pageall;i++){
$scope.pagealladd.push({a:i});
}

$scope.selectpage = page;
$scope.selectthispage = page;
        });
   };
$scope.getlist('','1');







$(document).ready(function (e) {
    $('#uploadImg').on('submit',(function(e) {

    $('#savefile').prop('disabled',true);	

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: 'Doc/Add',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){ 
$( "#uploadImg" )[0].reset();
$('#Openadd').modal('hide');
$('#savefile').prop('disabled',false);	
$scope.getlist();


            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

 
});



$scope.Editinputproduct = function(x){
	$('#Openedit').modal('show');
$("#id").val(x.id);
$("#title").val(x.title);
$("#des").val(x.des);

};





$(document).ready(function (e) {
    $('#Updatedata').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: 'Doc/Update',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){ 
$( "#Updatedata" )[0].reset();
$scope.getlist('',$scope.selectthispage,$scope.perpage);
$('#Openedit').modal('hide');
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

});





$scope.Deleteproduct = function(x){
$http.post("Doc/Delete",{
	id: x.id,
	file: x.file
	}).success(function(data){
toastr.success('สำเร็จ');
$scope.getlist();
        });	
};

   




});
	</script>
