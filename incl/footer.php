
					<nav>
						<ul>
							<?php 
								//if(isset($admin) && ($admin == "secretpage"))
								//{
									include("incl/adminmenu.php"); 
								//}
								//else
								//{
									include("incl/mainmenu.php");
								//}
							?>
						</ul>
					</nav>
					
					
				</div><!-- end main -->
				
                <footer>
                    Kontaktinformation
                </footer>

            </div><!-- end wrapper -->
			
			<?php if(isset($accordion)) { ?>
	            <script type="text/javascript">
	            $(document).ready(function() {
	            	$(".accordion").accordion( { heightStyle: "content" } );
	            });
	            </script>
	        <?php } ?>

        </body>

    </html>