<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../../Recursos/book_image2.png">


    <title>Perfil</title>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
	<link href="style.css"	rel="stylesheet">
	<?php
	include_once '../../conexao.php';

	if(session_status()==PHP_SESSION_NONE){
    	session_start();
	}


	$user_id_page = $_GET['id'];
	if(isset($_SESSION['id_user'])){
		$user_id_session = $_SESSION['id_user'];
	}


	if($user_id_page == $_SESSION['id_user']){
		$isOwner = true;
	}
	else{
		$isOwner = false;
	}

	$query = "SELECT * FROM cadastro WHERE ID = $user_id_page";
	$result = mysqli_query($conexao, $query);
	if (mysqli_num_rows($result) > 0) {
		$query2 = "SELECT nome, email, seguidores, seguindo FROM cadastro WHERE ID = $user_id_page";
		$result2 = mysqli_query($conexao, $query);
		$user_infos = mysqli_fetch_assoc($result);
	}
	else{
		header("Location: ../../404.html");
		exit();
	}
		

	$imgPerfil = "../../Recursos/Perfis/".trim($user_infos['email']).".jpg";
	$imgErro = "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Windows_10_Default_Profile_Picture.svg/512px-Windows_10_Default_Profile_Picture.svg.png?20221210150350";
?>
	
	<script>
		$(document).ready(function() {
    		let nomeInput = $(".form-nome");
			const fileNome = $("#file-nome");
    		const updateForm2 = $("#updateForm2");
			const avisoSuccess = $("#avisoSuccess");
			const avisoError = $("#avisoError");
			const avisoFileError = $("#file-erro");

			//Função de atualização da imagem no HTML principal
			function updateFotoPrincipal(file){
				let foto = document.getElementById('imgFoto');
				let reader = new FileReader();
				reader.onload= () =>{
					foto.src = reader.result;
				}
				reader.readAsDataURL(file);
			}

			//Função de sucesso ao atualizar
			function success(response){
				avisoSuccess.css("display", "block");
				avisoSuccess.text(response);
				setTimeout(function() {
					avisoSuccess.css("display","none");
				}, 3000);
			}

			//Função de erro ao atualizar
			function error(response){
				avisoError.css("display", "block");
				avisoError.text("Insira um nome válido");
				setTimeout(function() {
					avisoError.css("display","none");
				}, 2000);
			}

			//Click do botão Salvar
    		$("#salvar-editar").click(function(event) {
        		event.preventDefault();
				const nomeH2 = document.getElementById("nomeHtml");
				let valorH2 = nomeH2.innerText;
        		const nome = nomeInput.val().trim();
				const fileInput = document.getElementById("file-input");
    			const file = fileInput.files[0];
				const Data = new FormData();

				//Verificações dos valores dos inputs
				if((nome !== "") && (nome !== valorH2)){
					Data.append("nome", nome);
				}
				else if(fileInput.files.length < 1){
					error("Insira um nome válido");
				}
				if(fileInput.files.length > 0){
					Data.append("upload", file);
				}
				
                // AJAX para atualizar o Nome e/ou Foto
                $.ajax({
                	type: "POST",
                	url: "update.php",
                	data: Data,
					processData: false,
            		contentType: false,
					
					//Tratamento das respostas do PHP
                	success: function(response) {
						if(response === "Nome alterado com sucesso!"){
							nomeH2.innerText = nome;
							success(response);
						}
						else if(response === "Imagem alterada com sucesso!"){
							success(response);
							fileNome.css("display", "none");
							fileInput.value = null;
							updateFotoPrincipal(file);
						}
						else if(response === "Imagem e nome alterados com sucesso!"){
							nomeH2.innerText = nome;
							success(response);
							fileNome.css("display", "none");
							fileInput.value = null;
							updateFotoPrincipal(file);
						}
						else if(response === "Formato de arquivo inválido, APENAS .JPG"){
							avisoFileError.css("display", "block");
							avisoFileError.text("Formato de arquivo inválido, APENAS .JPG");
							setTimeout(function() {
								avisoFileError.css("display","none");
							}, 2000);
						}
                	}
                });
    		});
		});
	</script>

  </head>

<body>
	<div class="principal font-type">
		<div class="cabecalho">
			<div class="navegacao">
    			<a href="../Pagina_Protegida/pagina_protegida.php">
      				<img class="return" id='return_dark' src="../../Recursos/esquerda_light.png" alt="Voltar">
    			</a>
  			</div>
			<div class="infos">
				<div class="imgperfil">
					<img id="imgFoto" src="<?php echo $imgPerfil;?>" onerror="this.src='<?php echo $imgErro;?>';" alt="Perfil">
        		</div>
				<div class="info-pessoal">
					<b class="nome" id="nomeHtml"><?php echo $user_infos['nome'];?></b>
					<p class="email"><?php echo $user_infos['email'];?></p>
					<div class="estatisticas">
						<button class="btn-seguidor-open" id="btn-seguidor-open">
							<span>
								<h3 id="seguidores"><?php echo $user_infos['seguidores'];?></h3> 
								seguidores
							</span>
							<div class="bola"></div>
							<span>
								<h3 id="seguindo"><?php echo $user_infos['seguindo'];?></h3> 
								seguindo
							</span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="perfil-conteudo">
			<div class='btns'>
			<?php
				if ($isOwner == true) {
				    echo "
				        <button type='button' class='btn btn-editar no-select' id='btn-editar'>Editar</button>
				    ";
				} else {
				    $queryIsSeguindo = "SELECT * FROM seguidor WHERE id_usuario_seguidor = $user_id_session AND id_usuario_seguido = $user_id_page";
				    $resultSeguindo = mysqli_query($conexao, $queryIsSeguindo);
				    $isSeguindo = mysqli_num_rows($resultSeguindo) > 0;
				
				    echo "<div id='follow-container'>";
				    if ($isSeguindo) {
				        echo "
				            <button type='button' class='btn btn-seguidor no-select' id='btn-deixardeseguir'>Deixar de seguir</button>
				        ";
				    } else {
				        echo "
				            <button type='button' class='btn btn-seguidor no-select' id='btn-seguir'>Seguir</button>
				        ";
				    }
				    echo "</div>";
				}
			?>

			<script>
			$(document).ready(function() {
			
				$(document).on("click", "#btn-seguir", function() {
					event.preventDefault();

					let seguidores = $("#seguidores");
					let id_usuario_session = "<?php echo $user_id_session;?>";
					let id_usuario_page = "<?php echo $user_id_page;?>";
					const Data = new FormData();
					Data.append("type", "seguir");
					Data.append("id_usuario_seguiu", id_usuario_session);
					Data.append("id_usuario_seguido", id_usuario_page);

			        $.ajax({
                		type: "POST",
                		url: "seguidor.php",
                		data: Data,
						processData: false,
            			contentType: false,

						success: function(response) {
							if(response === "success"){
			            	    $("#follow-container").html("<button type='button' class='btn btn-seguidor no-select' id='btn-deixardeseguir'>Deixar de seguir</button>");
								seguidores.text(parseInt(seguidores.text()) + 1);
							}
							else{
								//erro
								console.log(response);
							}
						}
			        });
			    });
			
			    $(document).on("click", "#btn-deixardeseguir", function() {
					event.preventDefault();

					let seguidores = $("#seguidores");
					let id_usuario_session = "<?php echo $user_id_session;?>";
					let id_usuario_page = "<?php echo $user_id_page;?>";
					const Data = new FormData();
					Data.append("type", "deixardeseguir");
					Data.append("id_usuario_seguiu", id_usuario_session);
					Data.append("id_usuario_seguido", id_usuario_page);

			        $.ajax({
                		type: "POST",
                		url: "seguidor.php",
                		data: Data,
						processData: false,
            			contentType: false,

						success: function(response) {
							if(response === "success"){
			            	    $("#follow-container").html("<button type='button' class='btn btn-seguidor no-select' id='btn-seguir'>Seguir</button>");
								seguidores.text(parseInt(seguidores.text()) - 1);
							}
							else{
								//erro
								console.log(response);
							}
						}
			        });
			    });
			});
			</script>

			</div>
		<?php
			if($isOwner == true){
				echo'
					<div class="textos">
						<h2>Livros favoritos<i class="bx bxs-heart"></i></h2>
						<p>Visíveis apenas para você</p>
					</div>
					<div class="livros favoritos">
				';
				//Recebe do banco de dados os livros escritos pelo usuario
    			$query = "
    				SELECT livros.titulo, livros.genero, livros.capa, livros.ID
					FROM favoritos
					JOIN cadastro ON favoritos.fk_idCliente = cadastro.ID
					JOIN livros ON favoritos.fk_idLivro = livros.ID
					WHERE favoritos.fk_idCliente = ".$user_id_session."
    			";

    			$resultadoexecutado = mysqli_query($conexao, $query);
				if (mysqli_num_rows($resultadoexecutado) > 0) {
					//Costrói o html principal da página com os livros já incluidos
    				while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
						echo "
						<a href='../Pagina_Protegida/Livro/livro.php?id=".$livro['ID']."' class='livro'>
							<img title='".$livro['titulo']."' onerror=".'this.src=\'../../Recursos/erro.png\';'." class='imagens' src='../../Recursos/Capas/".$livro['capa']."'>
							<div class='livro-info'>
								<h2>".$livro['titulo']."</h2>
								<h3>".$livro['genero']."</h3>
							</div>
						</a>
						";
					}
				}
				else{
					echo '<div class="aviso">-Nenhum livro foi adicionado como favorito</div>';
				}
				echo '
					</div>
				';
			}
		?>


			<div class="textos">
				<h2>Livros escritos<i class="bx bxs-book-alt"></i></h2>
				<?php 
					if($isOwner == true){
						echo'
						<p>Visíveis para todos</p>
					';
					}
				?>
			</div>
			<div class="livros escritos">
				<?php 
					//Recebe do banco de dados os livros escritos pelo usuario
    				$query = "
    				SELECT livros.titulo, livros.genero, livros.capa, livros.ID, cadastro.nome AS nome_autor
    				FROM livros 
    				JOIN cadastro ON livros.autor = cadastro.ID WHERE livros.autor = '".$user_id_page."'
    				";

    				$resultadoexecutado = mysqli_query($conexao, $query);
					if (mysqli_num_rows($resultadoexecutado) > 0) {
						//Costrói o html principal da página com os livros já incluidos
    					while ($livro = mysqli_fetch_assoc($resultadoexecutado)) {
							echo "
							<a href='../Pagina_Protegida/Livro/livro.php?id=".$livro['ID']."' class='livro'>
								<img title='".$livro['titulo']."' onerror=".'this.src=\'../../Recursos/erro.png\';'." class='imagens' src='../../Recursos/Capas/".$livro['capa']."'>
								<div class='livro-info'>
									<h2>".$livro['titulo']."</h2>
									<h3>".$livro['genero']."</h3>
								</div>
							</a>
							";
						}
					}
					else{
						echo '<div class="aviso">Nenhum livro foi escrito</div>';
					}
				?>
			</div>
		</div>
	</div>
		<div class="editar-perfil">
			<div class="navs" style="display: flex;">
				<button id="fechar-editar" class="fechar"><i class="bx bx-x"></i></button>
				<h2>Editar perfil</h2>
				<button id="salvar-editar" class="salvar">Salvar</button>
			</div>
			<div class="conteudo">
				<form method="POST" id="updateForm" enctype="multipart/form-data" class="file-input-form">
					<label for="file-input" class="input-file">
						<div class="imgperfil">
							<img id="imgPhoto" src="<?php echo $imgPerfil;?>" onerror="this.src='<?php echo $imgErro;?>';" alt="Perfil">
        				</div>
						<div class="texto">
							Trocar foto
						</div>
						<input type="file" id="file-input" name="upload" accept="image/*" style="display: none;">
					</label>
					<p id="file-nome" class="file-name"></p>
					<p id="file-erro" class="file-erro"></p>
				<script>
					const fileInput = document.getElementById('file-input');
					let foto = document.getElementById('imgPhoto');
					const fileSelecionado = document.getElementById('file-nome');
					fileInput.addEventListener('change', function() {
						if(fileInput.files.lenght <= 0 ){
							return;
						}
						let reader = new FileReader();
						reader.onload= () =>{
							foto.src = reader.result;
							fileSelecionado.style.display = "block";
							fileSelecionado.textContent = this.value.split('\\').pop();
						}
						reader.readAsDataURL(fileInput.files[0]);
					});
				</script>
                    <!-- Campo de texto NOME -->
                    <input name="nome" type="text" class="form-nome" autocomplete="off" placeholder="Nome" value="<?php echo $user_infos['nome']?>">
					<p class="desc">É como você aparecerá no eLibrary</p>
					<div class="text-success" id="avisoSuccess"></div>
					<div class="text-error" id="avisoError"></div>
				</form>
			</div>
		</div>
		<div class="mostrar-seguidor">
			<div class="nav-seguidor" style="display: flex;">
				<button id="fechar-seguidor" class="fechar"><i class="bx bx-x"></i></button>
				<div class="botoesNav">
					<button class="btn-nav-seguidor btn-active" id="btn-seguidores">Seguidores</button>
					<button class="btn-nav-seguidor" id="btn-seguindo">Seguindo</button>
				</div>
			</div>
			<div class="seguidor-conteudo">
				<div class="seguidores">
						<div class="perfis">
							<?php 
								$query = "SELECT cadastro.nome, cadastro.ID, cadastro.email
								FROM cadastro
								JOIN seguidor ON seguidor.id_usuario_seguidor = cadastro.ID
								WHERE seguidor.id_usuario_seguido = $user_id_page
								";

								$resultSeguidor = mysqli_query($conexao, $query);

								if (mysqli_num_rows($resultSeguidor) > 0) {
									//Costrói as caixas referentes aos seguidores
									while ($users = mysqli_fetch_assoc($resultSeguidor)) {
										$imgPerfilSeguidores = "../../Recursos/Perfis/".trim($users['email']).".jpg";
										echo "
									
										<a href='perfil.php?id=".$users['ID']."' class='caixa'>
											<div class='parte1'>
												<div class='imgseguidor'>
													<img id='imgPhoto' src='$imgPerfilSeguidores' onerror=\"this.src='$imgErro';\" alt='Perfil'>
        										</div>
											</div>
											<div class='parte2'>
												<h4>".$users['nome']."</h4>
											</div>
										</a>
									
										";
									}
								}
								else{
									echo "Nenhum perfil seguidor encontrado";
								}
							?>
						</div>	
				</div>
				<div class="seguindo">
					<div class="perfis">
							<?php 
								$query = "SELECT cadastro.nome, cadastro.ID, cadastro.email
								FROM cadastro
								JOIN seguidor ON seguidor.id_usuario_seguido = cadastro.ID
								WHERE seguidor.id_usuario_seguidor = $user_id_page
								";

								$resultSeguidor = mysqli_query($conexao, $query);

								if (mysqli_num_rows($resultSeguidor) > 0) {
									//Costrói as caixas referentes aos seguidores
									while ($users = mysqli_fetch_assoc($resultSeguidor)) {
										$imgPerfilSeguidores = "../../Recursos/Perfis/".trim($users['email']).".jpg";
										echo "
									
										<a href='perfil.php?id=".$users['ID']."' class='caixa'>
											<div class='parte1'>
												<div class='imgseguidor'>
													<img id='imgPhoto' src='$imgPerfilSeguidores' onerror=\"this.src='$imgErro';\" alt='Perfil'>
        										</div>
											</div>
											<div class='parte2'>
												<h4>".$users['nome']."</h4>
											</div>
										</a>
									
										";
									}
								}
								else{
									echo "Nenhum perfil seguido encontrado";
								}
							?>
						</div>	
				</div>
			</div>
		</div>
		<script>
			function editar(){
				botaoEditar = document.getElementById('btn-editar');
				botaoFecharEdit = document.getElementById('fechar-editar');
				pageEditar = document.querySelector('.editar-perfil');
				botaoEditar.addEventListener("click", () => {
					pageEditar.style.height = "100%";
				});
				botaoFecharEdit.addEventListener("click", () => {
					pageEditar.style.height =  0;
				});
			}

			function seguidor(){
				botaoSeguidor = document.getElementById('btn-seguidor-open');
				botaoFecharSeguidor = document.getElementById('fechar-seguidor');
				pageSeguidor = document.querySelector('.mostrar-seguidor');
				botaoSeguidores = document.getElementById('btn-seguidores');
				botaoSeguindo = document.getElementById('btn-seguindo');
				seguidores = document.querySelector('.seguidores');
				seguindo = document.querySelector('.seguindo');

				botaoSeguidor.addEventListener("click", () =>{
					pageSeguidor.style.width = "100%";
				});
				botaoFecharSeguidor.addEventListener("click", () => {
					pageSeguidor.style.width =  0;
				});
				botaoSeguidores.addEventListener("click", () => {
					botaoSeguidores.classList.add("btn-active");
					botaoSeguindo.classList.remove("btn-active");
					seguidores.style.display =  "block";
					seguindo.style.display = "none";
				});
				botaoSeguindo.addEventListener("click", () => {
					botaoSeguidores.classList.remove("btn-active");
					botaoSeguindo.classList.add("btn-active");
					seguidores.style.display =  "none";
					seguindo.style.display = "block";
				});
			}

			if("<?php echo $isOwner;?>" == true){
				editar();
			}
			
			seguidor();


		</script>
</body>
</html>