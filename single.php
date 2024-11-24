<?php
/**
 * Шаблон отдельной записи (single.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
if ('reviews' == get_post_type()) {
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 ); exit();
}
get_header(); // подключаем header.php 
$h1 = (get_field('h1'))?get_field('h1'):get_the_title();
?>

<?php
    $theme_url = get_stylesheet_directory_uri();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .content-main {
        width:790px;
    }
    

    .wrap-content {
        display:flex;
        justify-content: space-start;
        flex-wrap: wrap;
    }
    
    .single-post-header {
        width: 790px;
        height: 400px;
        background-size:cover !important;
        background-repeat: no-repeat !important;
        border-radius:5px;
        margin-bottom:25px;
        max-width: 100%;
        position:relative;
        
    }
    
    .single-post-header:after {
        content:'';
        display:block;
        position:absolute;
        width:100%;
        height:100%;
        top:0;
        left:0;
        background:rgba(0,0,0,.3);
        border-radius:5px;
        z-index: 1;
    }
    
    .singl-post-title {
        position:absolute;
        color:#fff;
        bottom:35px;
        left:35px;
        width:70%;
        margin-bottom:0;
        z-index: 10 !important;
        
    }
    
    .wp-block-image {
        border-radius: 5px;
    }
    
    figure {
    margin-bottom:10px;}
    
    .sidebar-blog {
        width:202px;
        margin-left:68px;
    }
    
    .sidebar-title {
        font-family: 'Roboto';
font-style: normal;
font-weight: 700;
font-size: 24px;
line-height: 28px;
        margin-top:0;
    }
    
    .sidebart-thumb {
        width:202px;
          
        border-radius:5px;
    }
    
    .sidebar-post-title {
        font-family: 'Roboto';
font-style: normal;
font-weight: 700;
font-size: 18px !important;
line-height: 21px;
color: #0C0C0C !important;
        display:block ;
        margin-top:15px;
        margin-bottom:30px;
    }
    .sidebar-tour-title {
               font-family: 'Roboto';
font-style: normal;
font-weight: 700;
font-size: 18px !important;
line-height: 21px;
color: #0C0C0C !important;
        display:block ;
    }
    
    .flex-wrap-tours {
        display:flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom:30px;
    }
    
    .flex-wrap-tours svg {
        flex:0 0 10%;
    }
    
    .img-wrapper  {
        width:202px;
        height:180px;
        overflow: hidden;
        border-radius: 5px;
        
    }
    
    .recomendation {
        width:100%;
        border: 1px solid #90C6D9;
border-radius: 10px;
        padding:16px;
        font-family: 'Roboto';
font-style: normal;
font-weight: 700;
font-size: 18px;
line-height: 21px;
        margin-top:30px;
    }
    
    .recomendation a {
        font-style: normal;
font-weight: 700; 
font-size: 18px;
line-height: 21px;
    }
    
    @media screen and (max-width:1034px){
        .content-main {
        width:739px;
    }
        
         .singl-post-title {
        position:absolute;
        color:#fff;
        bottom:30px;
        left:30px;
        width:70%;
             font-size: 22px;
    }
    }
    
    @media screen and (max-width:972px){
        .single-post-header {
            height:300px;
        }
        .sidebar-blog {
            width:100%;
            margin-top:42px;
            margin-left:0;
        }
        
         .sidebar-post-title {
  
font-size: 16px !important;
 
    }
    .sidebar-tour-title {
             
font-size: 16px !important;
 
    }
        .single-post-header{
            width:100%;
        }
        .content-main {
        width:100%;
         
    }
        .flex-wrap-tours svg {
        flex:0 0 5%;
    }
        .sidebar-blog-container {
            width:100%;
            display:flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .sidebar-post-item, .flex-wrap-tours {
            flex:0 0 30%;
        }
        .sidebart-thumb {
            width:100% !important;
            height:auto !important;
        }
        
         .img-wrapper  {
        width:100%;
        
    }
    }
    
    @media screen and (max-width:654px){
         .sidebar-post-item, .flex-wrap-tours {
            flex:0 0 47%;
        }
        .single-post-header {
            height:200px;
        }
        .singl-post-title {
        position:absolute;
        color:#fff;
        bottom:19px;
        left:16px;
        width:90%;
            font-size:22px;
    }
    }
    
     @media screen and (max-width:415px){
         .sidebar-post-item, .flex-wrap-tours {
            flex:0 0 100%;
        }
         .img-wrapper {
             height:180px;
             overflow: hidden;
             border-radius:5px;
             
         }
		 .content--post .tour {
			 padding-bottom:30px
		 }
         .sidebart-thumb {
           position:relative;
             bottom:40%;
         }
    }
    
    .content {
        padding-bottom:120px !important;
    }
	
	.slick-track {
		display:flex;
		align-items:stretch;
	}
</style>
<section class="content content--thanks">
    <?php if ( has_post_thumbnail() ) : ?>
        <?php $thumbnail_id = get_post_thumbnail_id(); ?>
        <?php $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, 'full' )[0]; ?>
        <?php $thumbnail_meta = wp_get_attachment_metadata( $thumbnail_id ); ?>
    <?php endif; ?>

	<div class="container wrap-content">
        <div class="content-main">
       
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
			<?php
			/*<div class="autor_top">
				<div class="autor_top__info">
					<div class="autor_top__img" style="background-image:url(<?=$theme_url?>/img/mariya.jpg)"></div>
					<div class="autor_top__text">
						<div class="autor_top__name">Мария Тарасовская</div>
						<div class="autor_top__title">Автор блога</div>
					</div>
				</div>
				<a href="#autors" class="autor_top__btn">Подробнее об авторе</a>
			</div> */ ?>
            <?php
          if ( has_post_thumbnail() ):
                    echo '<div class="single-post-header" style="background:url(' .get_the_post_thumbnail_url($post->ID, 'large'). '); 
        position:relative;" ><h1 class="singl-post-title">'.$h1.'</h1></div>';
          else:
            echo '<h1>'.$h1.'</h1>';
          endif;
			?>
			
			<div><?php the_content(); ?></div>
    
			<div class="autor_bot">
				<div class="autor_bot__info">
					<div class="autor_bot__img" style="background-image:url(<?=$theme_url?>/img/mariya.jpg)"></div>
					<div class="autor_bot__text">
						<div class="autor_bot__name">Мария Тарасовская</div>
						<div class="autor_bot__title">Автор блога</div>
					</div>
				</div>
				<div class="autor_bot__content">
					<p>Мария - автор нашего блога, настоящий знаток и ценитель Санкт-Петербурга. Любовь к этому уникальному городу и его истории вдохновляет ее делиться с читателями интересными фактами, полезными советами и увлекательными маршрутами.</p>
					<p>Мария рассказывает не только о популярных туристических местах, но и о скрытых жемчужинах города, о которых чаще всего не упоминают туристические путеводители. Если вы не знаете, куда пойти и что посмотреть в Петербурге и окрестностях, то наш блог для вас!</p>
				</div>
				<div class="autor_bot__gids" id="autors">
					<div class="autor_bot__gids_title">В качестве консультантов-экспертов выступают наши гиды:</div>
					<a class="autor_bot__gid" href="https://t.me/illuziipiterodaktilia" target="_blank">
						<div class="autor_bot__img" style="background-image:url(<?=$theme_url?>/img/aleksey.jpg)"></div>
						<div class="autor_bot__text">
							<div class="autor_bot__name">Алексей Крайковский</div>
							<div class="autor_bot__title">аккредитованный специалист, историк,<br>кандидат исторических наук</div>
						</div>
					</a>
					<a class="autor_bot__gid" href="https://vk.com/id1738891" target="_blank">
						<div class="autor_bot__img" style="background-image:url(<?=$theme_url?>/img/elena.jpg)"></div>
						<div class="autor_bot__text">
							<div class="autor_bot__name">Елена Кузина</div>
							<div class="autor_bot__title">лицензированный экскурсовод в музеях<br>и дворцах Петербурга и пригородов</div>
						</div>
					</a>
				</div>
			</div>
			
			<script type="application/ld+json">
				{
					"@context": "https://schema.org",
					"@type": "NewsArticle",
					"headline": "<?=$h1?>",
					<?php if (has_post_thumbnail()): ?>
						"image": [
							"<?=get_the_post_thumbnail_url($post->ID, 'large')?>"
						],
					<?php endif ?>
					"datePublished": "<?=get_the_date('Y-m-d\TH:i:s+05:00')?>",
					"dateModified": "<?=get_the_modified_date('Y-m-d\TH:i:s+05:00')?>",
					"author": [
						{
							"@type": "Person",
							"name": "Мария Тарасовская"
						},
						{
							"@type": "Person",
							"name": "Алексей Крайковский",
							"url": "https://t.me/illuziipiterodaktilia"
						},
						{
							"@type": "Person",
							"name": "Елена Кузина",
							"url": "https://vk.com/id1738891"
						}
					]
				}
			</script>
	
        <?php endwhile; ?>
    </div>
        <div class="sidebar-blog">
    <h2 class="sidebar-title">Ещё интересное</h2>
            <div class="sidebar-blog-container">
    <?php
        $query = new WP_Query( array(
			         'post_type' => 'post',
			         'orderby' => 'id',
			         'order' => 'DESC',
	                 'posts_per_page' => 10,
			         'category__in' => ['58'],
                     'post__not_in'           => [get_the_ID()]
	 
) );

while( $query->have_posts() ) : $query->the_post();
    setup_postdata($post);
			?><a href="<?php echo get_the_permalink() ?>"><div class="sidebar-post-item">
            <?php if(has_post_thumbnail()): ?>
            <div class="img-wrapper"><img src="<?php echo get_the_post_thumbnail_url($post->ID, 'big-thumb') ?>" alt="Картинка записи" class="sidebart-thumb" /></div>
            <?php endif; ?>
			<?php echo '<p class="sidebar-post-title">' .$post->post_title; ?></p></div></a>
		 
			<?php
 
endwhile;
 
			wp_reset_postdata(); 
          
        
//              $query = new WP_Query( array(
// 			         'post_type' => 'post',
// 			         'orderby' => 'id',
// 			         'order' => 'ASC',
// 	                 'posts_per_page' => 3,
// 				     'category__in' => ['58'],
// 				     'post__not_in'           => [get_the_ID()]
                     
	 
// ) );
// echo '<div class="post-interesting-secont">';
// while( $query->have_posts() ) : $query->the_post();
//     setup_postdata($post);
// 	   echo '<div class="flex-wrap-tours"><a href="'. get_the_permalink(). '" class="sidebar-tour-title">' .$post->post_title; ?>

		 
<?php
 
// endwhile;
 
// 			wp_reset_postdata(); 
        
//           echo '</div>';
    ?>
    </div>
    </div>
   </div>    
</section>

<?php get_footer(); // подключаем footer.php ?>