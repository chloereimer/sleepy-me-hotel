<section class="content">
  <p>This webpage should represent a complete Lab 1 for <em>Web 2.0 & PHP Frameworks (COMP 10125)</em>.</p>
  <h1>First, let's demonstrate the asset helper.</h1>
  <p>Below is an image from our <code>assets/images</code> folder. If you don't want to dig into the source of this view, here's how I inserted it: <code>&lt;img src="&lt;?php images_url('some_innocuous_old_photograph.jpg') ?&gt;"&gt;</code></p>
  <p><img src="<?php echo images_url('some_innocuous_old_photograph.jpg'); ?>" alt="A room full of happy partygoers in 1921."></p>
  <h1>Next, let's talk about frameworks.</h1>
  <p>The Sleepy-Me Hotel website implements ZURB'S front-end framework, <a href="http://foundation.zurb.com" target="_blank">Foundation</a>. Like all good frameworks, Foundation includes a grid system, which I've used here.</p>
  <p>It also has comprehensive base styles for tags—you've seen the base style for the <code>code</code> tag above, but that's pretty standard. Their base styles for form elements are just one area where they make bigger design decisions:</p>
  <fieldset>
    <legend>Like this fieldset...</legend>
    <input type="text" placeholder="...and this text input box...">
    <button>...and this button.</button>
  </fieldset>
  <p>I'll override some of these styles (I've already started), but they're a good start.</p>
  <p>Foundation isn't merely a CSS framework, though; it also includes some helpers for page behaviour through JavaScript/jQuery. This includes little details like tooltips (<span data-tooltip aria-haspopup="true" class="has-tip" title="This is a tooltip!">like the one you'll see if you hover over this text</span>) or bigger stuff like modal windows (<a href="#" data-reveal-id="exampleModal">like the one that'll pop up if you click this text</a>).</p>

  <div id="exampleModal" class="reveal-modal" data-reveal>
    <h1>Wow, a modal window!</h1>
    <p>The future is here!</p>
    <a class="close-reveal-modal">&#215;</a>
  </div>
</section>
