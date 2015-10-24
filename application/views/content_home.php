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

  <section class='site-list'>
    <ul>
      <li>Lorem.</li>
      <li>Quibusdam.</li>
      <li>Ipsam.</li>
      <li>Alias!</li>
      <li>Dolorum.</li>
    </ul>
  </section>

  <section class="site-bars">
    <label>Bar</label>
    <div class="test-bar">
      <span></span>
    </div>
    
    <label>Bar</label>
    <div class="test-bar">
      <span></span>
    </div>
    
    <label>Bar</label>
    <div class="test-bar">
      <span></span>
    </div>
    
    <label>Bar</label>
    <div class="test-bar">
      <span></span>
    </div>
    
    <label>Bar</label>
    <div class="test-bar">
      <span></span>
    </div>
  </section>

  <section class="containa">
    <div class="ball b0">
      
    </div>
    <div class="ball b1">
      
    </div>
    <div class="ball b2">
      
    </div>
    <div class="ball b3">
      
    </div>
    <div class="ball b4">
      
    </div>

  </section>
</div>

<div class="containa">
  <div class="bx">
    
  </div>
  <div class="bx">
    
  </div>
</div>

<script>
  
var bx = document.getElementsByClassName('bx');
var conty = document.getElementsByClassName('containa')[1];

  conty.onmouseover = function() {
    for (var i = bx.length - 1; i >= 0; i--) {
      bx[i].className = bx[i].className + ' active';
    }
  }
  conty.onmouseout = function() {
    for (var i = bx.length - 1; i >= 0; i--) {
      if (bx[i].className.indexOf('active')) {
        bx[i].className = bx[i].className.replace('active','').trim();
      };
    };
  }
  
  var stringUn = "This is a long string of text!";
  console.log(stringUn.toLowerCase());
  console.log(stringUn.toUpperCase());
  console.log(stringUn.slice(1, 4)+' - takes characters from index 1 till index 4');
  console.log(stringUn.substr(0, 4)+' - takes 4 characters starting from index 0');
  console.log(stringUn.replace("text", "characters")+' - "text" has been replaced with "characters"');
  console.log(stringUn.indexOf("is")+' - the first "is" appears at this index');
  console.log(stringUn.lastIndexOf("is")+' - the last "is" appears at this index');
  console.log(stringUn.charAt(stringUn.length-1)+' - this character is at index 0');

  console.log(stringUn.indexOf(['a','e','i','o','u']));

String.prototype.len = function() {
  return this.length;
}

console.log(stringUn.len());

</script>

<div class="hex-container">

  <div class="hex-bar">
    <div class="hexagon">
      <span>1</span>
      <div class="trii"></div>
    </div>
    <div class="hexagon">
      <span>3</span>
      <div class="trii"></div>
    </div>
  </div>

  <div class="hex-bar">
    <div class="hexagon">
      <span>2</span>
      <div class="trii"></div>
    </div>
    <div class="hexagon">
      <span>3</span>
      <div class="trii"></div>
    </div>
  </div>

  <div class="hex-bar">
    <div class="hexagon">
      <span>3</span>
      <div class="trii"></div>
    </div>
    <div class="hexagon">
      <span>3</span>
      <div class="trii"></div>
    </div>
  </div>

  <div class="hex-bar">
    <div class="hexagon">
      <span>4</span>
      <div class="trii"></div>
    </div>
    <div class="hexagon">
      <span>3</span>
      <div class="trii"></div>
    </div>
  </div>

</div>


<div class="pure-hex-container">
  <div class="pure-hex">
    <div class="tri">
      
    </div>
    <div class="sq">
      <span>1</span>
    </div>
    <div class="tri">
      
    </div>
  </div>
  <div class="pure-hex">
    <div class="tri">
      
    </div>
    <div class="sq">
      <span>2</span>
    </div>
    <div class="tri">
      
    </div>
  </div>
  <div class="pure-hex">
    <div class="tri">
      
    </div>
    <div class="sq">
      <span>3</span>
    </div>
    <div class="tri">
      
    </div>
  </div>
  <div class="pure-hex">
    <div class="tri">
      
    </div>
    <div class="sq">
      <span>4</span>
    </div>
    <div class="tri">
      
    </div>
  </div>
  <div class="pure-hex">
    <div class="tri">
      
    </div>
    <div class="sq">
      <span>5</span>
    </div>
    <div class="tri">
      
    </div>
  </div>
  <div class="pure-hex">
    <div class="tri">
      
    </div>
    <div class="sq">
      <span>6</span>
    </div>
    <div class="tri">
      
    </div>
  </div>
  <div class="pure-hex">
    <div class="tri">
      
    </div>
    <div class="sq">
      <span>7</span>
    </div>
    <div class="tri">
      
    </div>
  </div>
</div>

<div class="parento">
  <div class="child"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non incidunt provident a reiciendis, accusamus voluptate.</span></div>
  <div class="child"><span>Et nisi inventore commodi nemo, maiores, vel nulla, amet esse aspernatur sapiente aperiam maxime provident.</span></div>
  <div class="child"><span>Obcaecati culpa, fugiat quaerat atque delectus explicabo doloribus tempore ullam veritatis iure, fugit vel, porro.</span></div>
  <div class="child"><span>Soluta nam fugiat voluptas deleniti vel nulla minus, aliquid, cumque beatae rem, impedit magni ut!</span></div>
  <div class="child"><span>Inventore quis aliquam repellendus, delectus, fuga modi enim, molestias ullam, a maiores quo numquam sed!</span></div>
  <div class="child"><span>Nam inventore atque id accusamus quasi aliquam, consectetur mollitia ratione explicabo laboriosam earum quia vitae.</span></div>
  <div class="child"><span>Reiciendis suscipit quia, culpa rerum voluptatum commodi dignissimos! Amet, autem tempora veniam laboriosam ducimus. Amet!</span></div>
  <div class="child"><span>Sed facere, ut corporis cupiditate iusto, veniam! Vero error dolor consequuntur reprehenderit culpa sequi animi?</span></div>
  <div class="child"><span>Omnis modi recusandae aperiam nemo amet, officia at nostrum tempora ea minima? Ipsum, quae, iste!</span></div>
  <div class="child"><span>Quibusdam magni optio animi, soluta perspiciatis consequatur numquam. Odio dolore voluptas sed enim quasi, facilis!</span></div>
</div>
<?php 

 ?>