
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Club Photo</title>
		<link rel="stylesheet" type="text/css" href="config/global.css" />
	</head>
	<body>
		<div class="content">
			<div class="white">
			<!-- Zone titre -->
			<?php
                include 'bloc_entete.php';
            ?>
			</div>

			<!-- Zone article -->
			<?php
                if (isset($_GET['page'])) {
                    include $_GET['page'] . ".php";
                } else {
                    include "accueil.php";
                }
            ?>

			<!-- Zone Pied de page -->
			<?php
                include 'bloc_pied.php';
            ?>
		</div>
		<!-- Zone menu -->
		<?php
            include 'bloc_menu.php';
        ?>
		<div id="arrow">
			<svg fill="#000000" height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
				<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
				<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
				<g id="SVGRepo_iconCarrier">
					<path id="XMLID_224_" d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394 l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393 C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"></path>
				</g>
			</svg>
		</div>
		<div id="arrow2">
			<svg fill="#000000" height="50px" width="50px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
				<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
				<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
				<g id="SVGRepo_iconCarrier">
					<path id="XMLID_224_" d="M325.606,229.393l-150.004-150C172.79,76.58,168.974,75,164.996,75c-3.979,0-7.794,1.581-10.607,4.394 l-149.996,150c-5.858,5.858-5.858,15.355,0,21.213c5.857,5.857,15.355,5.858,21.213,0l139.39-139.393l139.397,139.393 C307.322,253.536,311.161,255,315,255c3.839,0,7.678-1.464,10.607-4.394C331.464,244.748,331.464,235.251,325.606,229.393z"></path>
				</g>
			</svg>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				const menu = document.querySelector('.menu');
				const proximityThreshold = 100;

				function checkMouseProximity(event) {
					const mouseY = event.clientY;
					const windowHeight = window.innerHeight;

					if (mouseY > windowHeight - proximityThreshold) {
						menu.classList.add('visible');
						arrow.classList.add('hide')
						arrow2.classList.add('hide')
					} else {
						menu.classList.remove('visible');
						arrow.classList.remove('hide')
						arrow2.classList.remove('hide')
					}
				}
				window.addEventListener('mousemove', checkMouseProximity);
				});
				document.addEventListener('DOMContentLoaded', function() {
			document.querySelectorAll('.moreinfo').forEach(row => {
				row.addEventListener('mouseenter', () => {
					const nextRow = row.nextElementSibling;
					if (nextRow && nextRow.classList.contains('info')) {
						nextRow.classList.add('hover');
						row.classList.add('hover');
					}
				});
				row.addEventListener('mouseleave', () => {
					const nextRow = row.nextElementSibling;
					if (nextRow && nextRow.classList.contains('info')) {
						nextRow.classList.remove('hover');
						row.classList.remove('hover');
					}
				});
			});

			document.querySelectorAll('.info').forEach(row => {
				row.addEventListener('mouseenter', () => {
					row.classList.add('hover');
					const prevRow = row.previousElementSibling;
					if (prevRow && prevRow.classList.contains('moreinfo')) {
						prevRow.classList.add('hover');
					}
				});
				row.addEventListener('mouseleave', () => {
					row.classList.remove('hover');
					const prevRow = row.previousElementSibling;
					if (prevRow && prevRow.classList.contains('moreinfo')) {
						prevRow.classList.remove('hover');
					}
				});
			});
		});
		</script>

	</body>
</html>