<?php
    include_once('config/connect.php');
    $id = $_GET['id'];
    $sql_find = "select * from user where user_id = '$id'";
    $data = mysqli_query($connect, $sql_find);
    $user = mysqli_fetch_array($data);
?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="">Quản lý thành viên</a></li>
				<li class="active"><?php echo $user['user_full'];?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thành viên: <?php echo $user['user_full'];?></h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                                
                                <?php
                                    if(isset($_POST['sbm'])){
                                        $name = $_POST['user_full'];
                                        $mail = $_POST['user_mail'];
                                        $pass = $_POST['user_pass'];
                                        $pass2 = $_POST['user_re_pass'];
                                        $lv = $_POST['user_level'];

                                        $sql_check = "select * from user where user_mail = '$mail' and user_id <> '$id'";
                                        $data = mysqli_query($connect, $sql_check);
                                        if($temp = mysqli_fetch_array($data)){
                                            echo '<div class="alert alert-danger">Email đã tồn tại!</div>';
                                        }else if($pass != $pass2){
                                            echo '<div class="alert alert-danger">Mật khẩu không khớp!</div>';
                                        }else{
                                            $sql_check = "update user set user_full = '$name', user_mail = '$mail', user_pass = '$pass', user_level = '$lv' where user_id = '$id'";
                                            $data = mysqli_query($connect, $sql_check);
                                            header("location: admin.php?page_layout=user");
                                        }
                                    }
                                ?>
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Họ & Tên</label>
                                    <input type="text" name="user_full" required class="form-control" 
                                        <?php echo 'value="'.$user['user_full'].'"';?>
                                    placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="user_mail" required 
                                        <?php echo 'value="'.$user['user_mail'].'"';?>
                                    class="form-control">
                                </div>                       
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" name="user_pass" required  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" name="user_re_pass" required  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quyền</label>
                                    <select name="user_level" class="form-control">
                                        <?php 
                                            if($user['user_level'] == '1')
                                                echo '<option value=1 selected>Admin</option>
                                                    <option value=2>Member</option>';
                                            else echo '<option value=1>Admin</option>
                                                <option value=2 selected>Member</option>';
                                        ?>
                                        
                                    </select>
                                </div>
                                <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
