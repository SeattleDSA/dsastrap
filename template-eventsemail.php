<?php
/*
Template Name: Event List (for Email)
* @Part of the dsastrap theme
* @Displays list of five upcoming events using the category slug, new-member
*/
?>

<?php get_header(); ?>
	<div id="content" class="container">

		<style>
			footer, .footer, #non-printable {
				display: none !important;
			}

			div.recurringinfo {
				display: none;
			}

			ul.meta-details {
				margin-bottom: 3pt;
			}
			h1 a, h2 a, h3 a, h4 a {
				color: black;
			}
			h1 img {
			    border: 1pt solid #aaa;
				border-radius: 50%;
			}
			span.icon-calendar {
				font-size: 3rem;
				color: #ec1f27;
			}

			@media only screen and (max-width: 480px){
			    #templateColumns{
			    	width:100% !important;
			    }

			    .templateColumnContainer{
			    	display:block !important;
			    	width:100% !important;
			    }

			    .columnImage{
			        height:auto !important;
			        max-width:480px !important;
			        width:100% !important;
			    }
			}
		</style><!-- Hide Header/Footer -->
		
		<div class="cell col-md-12">
			<h1><span class="icon-calendar"></span> <?php the_title(); ?></h1>
			<?php the_content( 'Continue reading ' . get_the_title() ); ?>
			<hr />
		</div>
		<div class="cell col-md-12">
			<h3>Code Block</h3>
			<?php // Retrieve the next week worth of events
				if(in_array('the-events-calendar/the-events-calendar.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
					//plugin is activated

					$events = tribe_get_events( array(
					    'posts_per_page' => 20,
					    'start_date' => date( 'Y-m-d H:i:s', strtotime("-6 hours")),
					    'end_date' => date( 'Y-m-d H:i:s', strtotime("+1 week")),
					    'tax_query'=> array(
		                	array(
			                    'taxonomy' => 'tribe_events_cat',
			                    'field' => 'slug',
			                    'terms' => 'new-member'
		               		)
		                )
					) );
					
					function empty_content($str) {
						    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
					}
						echo "<pre><code class=\"language-html\">&lt;table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" id=\"copyMe\" class=\"templateColumns\"&gt;";
						// Loop through the events, displaying the title
						// and content for each
						foreach ( $events as $event ) {
							$title = $event->post_title;

							echo "&lt;tr style=\"border-bottom: 1px solid #202020;\"&gt;&lt;td align=\"center\" valign=\"middle\" width=\"15%\" style=\"text-align: center; vertical-align: middle;\"&gt;";

							echo "&lt;span class=\"dsa-event-textmonth\"&gt;" . tribe_get_start_date( $event->ID, $display_time = false, $date_format = "M" ) . "&lt;/span&gt;&lt;br&gt;";

							echo "&lt;span class=\"dsa-event-numericday\" style=\"font-size: 2rem; font-weight:bold;\"&gt;" . tribe_get_start_date( $event->ID, $display_time = false, $date_format = "j" ) . "&lt;/span&gt;&lt;br&gt;";

							echo "&lt;span class=\"dsa-event-textday\"&gt;" . tribe_get_start_date( $event->ID, $display_time = false, $date_format = "D" ) . "&lt;/span&gt;&lt;br&gt;";

						    echo "&lt;/td&gt;&lt;td align=\"left\" valign=\"middle\" width=\"84%\" style=\"vertical-align: middle; text-align: left;\"&gt;";
						    echo "&lt;span class=\"dsa-event-time\"&gt;" . tribe_get_start_time( $event->ID ) . " - " . tribe_get_end_time( $event->ID ) . "&lt;/span&gt;&lt;br&gt;";
						    echo "&lt;h3&gt;&lt;a href=\"" . tribe_get_event_link( $event->ID, $full_link=false) . "\"&gt". $title . "&lt;/a&gt&lt;/h3&gt;";
							
							echo "&lt;span class=\"dsa-event-location\"&gt;&lt;strong&gt;" . tribe_get_venue ( $event->ID, $link = false ) . "&lt;/strong&gt;&lt;/span&gt; &lt;span class=\"dsa-event-city\"&gt;" . tribe_get_city ($event->ID, $link = false);

						    echo "&lt;/span&gt;&lt;/tr&gt;";
						}
						echo "&lt;/table&gt;</code></pre>";
					}
					else {
						echo "<div>This template uses The Events Calendar plugin. Please install.</div>";
					}
			?>
		</div>
	</div> <!-- end #content -->

	 <style>
			*, *:before, *:after {
			  box-sizing: border-box;
			}

			pre {
				white-space: pre-wrap;
			}

			pre[class*="language-"] {
			  position:relative;
			  overflow: auto;
			  margin:5px 0;
			  padding:1.75rem 0 1.75rem 1rem;
			  border-radius:10px;
			}

			pre button {
			    position: absolute;
			    font-size: .9rem;
			    margin: 0.5rem;
			    background-color: #ec1f27;
			    color: #fff;
			    border: ridge 1px #ec1f27;
			    border-radius: 5px;
			    position: absolute;
			}
    </style>
    <script type="text/javascript">
      const copyButtonLabel = "Copy Code";

			// you can use a class selector instead if you, or the syntax highlighting library adds one to the 'pre'. 
			let blocks = document.querySelectorAll("pre");

			blocks.forEach((block) => {
			  // only add button if browser supports Clipboard API
			  if (navigator.clipboard) {
			    let button = document.createElement("button");
			    button.innerText = copyButtonLabel;
			    button.addEventListener("click", copyCode);
			    block.appendChild(button);
			  }
			});

			async function copyCode(event) {
			  const button = event.srcElement;
			  const pre = button.parentElement;
			  let code = pre.querySelector("code");
			  let text = code.innerText;
			  await navigator.clipboard.writeText(text);
			  
			  button.innerText = "Code Copied";
			  
			  setTimeout(()=> {
			    button.innerText = copyButtonLabel;
			  },1000)
			}
    </script>

<?php get_footer(); ?>