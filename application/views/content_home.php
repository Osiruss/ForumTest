<div class="home">
  <section class='site-banner'>
  
  </section>
  
  <section class="site-container">
  <span></span>
  <?php for ($i=0; $i < count($posts); $i++) { ?>
    <article class="site-article article--small">
      <a class="contain" href="<?php echo base_url('post/'.$posts[$i]->post_id) ?>">
        <header class='article-header'>
          <h1><?php echo $posts[$i]->subject ?></h1>
        </header>
        <p class="article-content"><?php echo substr($posts[$i]->message, 0, 120).'...'; ?></p>
      </a>
      <footer class="article-footer">
        <p class="article-details byline">by <?php echo $posts[$i]->username . ' ' . $posts[$i]->ago ?> ago</p>
      </footer>
    </article>
  <?php } ?>
  </section>
</div>