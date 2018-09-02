<?php  ?>
<body>
    <div class="container" style="width: 50%; max-height: 100%;">
        <div class="col-lg-7 col-md-offset-3 " id="sesion" style="margin-top: 10px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <label style="font-size: 25px; text-align: center;">
                        Subdirección de Investigación y Posgrado
                    </label>
                </div>
                <div class="panel-body">
                    <label style="font-size: 25px; margin-left: 80px;">
                        Acceso al sistema
                    </label>
                    <img class="profile-img-card" id="profile-img" src="../img/user-128.png">
                        <div class="col-lg-12 form-group">
                            <input class="form-control" id="Usuario" name="" placeholder="Usuario" type="text">
                            </input>
                        </div>
                        <div class="col-lg-12 form-group">
                            <input class="form-control" id="password" name="" placeholder="Contraseña" type="password">
                            </input>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label id="error" style="color: red">
                            </label>
                        </div>
                        <div class="col-lg-12 form-group">
                            <button class="btn btn-primary btn-lg btn-block" id="btn-p" style="margin-top: -40px;" type="button"  onclick="login()">
                                Iniciar sesión
                            </button>
                        </div>
                        <div class="col-lg-12">
                            <label>
                                <input class="form-group" name="pass" type="checkbox" value="">
                                    Recordar contraseña
                                </input>
                            </label>
                        </div>
                    </img>
                </div>
            </div>
        </div>
    </div>
</body>
<style type="text/css">
.profile-img-card{
	left:0;
	right:0;
	margin-left:auto;
	margin-right:auto;
	margin: 0 auto 10px;
	display: block;
	margin-bottom: 25px;
	margin-top: 5px;
}
#en{
	background: white;
}
</style>