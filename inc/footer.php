        <hr>
    </div> <!-- /container -->

    <footer class=" py-5">
            <?php $data = new DateTime("now", new DateTimeZone("America/Sao_Paulo")); ?>
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted"><p>&copy;2024 a <?php echo $data -> format("Y"); ?> - Vinícius Ribeiro Lopes e Gustavo Félix da Silva Camargo</p></div></div>
        </footer>

        <script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
        <script src="<?php echo BASEURL; ?>js/main.js"></script>
        
        <!-- SimpleLightbox plugin JS-->
        <script src="<?php echo BASEURL; ?>https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="<?php echo BASEURL; ?>https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>

		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		<!-- <script src="http://localhost:3002/dist/aos.js"></script> -->

		<script>
			AOS.init({
				easing: 'ease-out-back',
				duration: 1000
			});
		</script>
    </body>
</html>