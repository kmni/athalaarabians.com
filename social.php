<?php
    include 'blocks/header-inner.php';
?>

    <!-- Facebook BEGIN -->
    <ul id="facebook">
        <li>Loading…</li>
    </ul>
    <ul id="facebook_albums">
        <li>Loading…</li>
    </ul>
    <script id="facebook_template" type="text/x-jquery-tmpl">
    {{if type != "status" || typeof message != "undefined" || typeof caption != "undefined" }}
    <li class="clearfix">
      <a class="image" href="http://www.facebook.com/profile.php?id=${from.id}" target="_blank"><img alt="picture" src="https://graph.facebook.com/${from.id}/picture"></a>
      <div class="header">
        <a class="author" href="http://www.facebook.com/profile.php?id=${from.id}" target="_blank"><strong>${from.name}</strong></a> 
        {{if type == "link"}}
        shared a 
        <a href="http://www.facebook.com/profile.php?id=${from.id}" target="_blank">link</a>
        {{/if}}
        (<abbr class="timeago" title="${created_time}">${created_time}</abbr>)
      </div> <!--// .header -->
      <p>{{html message}}</p>
      <p>{{html caption}}</p>
      {{if type == "link"}}
      <div class="link">
      {{if picture}}
        <a class="image" href="${link}" target="_blank"><img alt="picture" src="${Social.facebookPictureURL(picture)}"></a>
      {{/if}}
        <a href="${link}" target="_blank"><strong>${name}</strong></a> <i>${caption}</i>
        {{if description}}
        <p>${description}</p>
        {{/if}}
      </div> <!--// .link -->
      {{else}}
        {{if picture}}
      <div class="picture">
        <a href="${link}" target="_blank"><img alt="picture" src="${Social.facebookPictureURL(picture)}"></a>
      </div> <!--// .picture -->
        {{/if}}
      {{/if}}
    </li>
    {{/if}}
    </script>
    <script id="facebook_album_template" type="text/x-jquery-tmpl">
    {{if type != "friends_walls"}}
    <li>
      <a class="image" href="${link}" target="_blank"><img src="https://graph.facebook.com/${id}/picture?type=album" alt="picture"></a>
      <a href="${link}" target="_blank">${name}</a>
      <span>{{if count}} {{if count == 1}}1 photo {{else}}${count} photos{{/if}} {{/if}}</span>
    </li>
    {{/if}}
    </script>
    <script id="facebook_template" type="text/x-jquery-tmpl">
    {{if type != "status" || typeof message != "undefined" || typeof caption != "undefined"}}
    <li>
      <div class="header">
        <a href="http://www.facebook.com/profile.php?id=${from.id}" target="_blank"><img alt="picture" src="https://graph.facebook.com/${from.id}/picture">
        </a>
        <a href="http://www.facebook.com/profile.php?id=${from.id}" target="_blank"><strong>${from.name}</strong>
        </a>
        {{if type == "link"}}
        shared a
        <a href="http://www.facebook.com/profile.php?id=${from.id}" target="_blank">link</a>
        {{/if}}
        <br>
        <abbr class="timeago" title="${created_time}">${created_time}</abbr>
      </div>
      <p>
        {{html message}}
      </p>
      {{if type == "link"}}
      <div class="link">
        <a href="${link}" target="_blank">{{if picture}}
        <img alt="picture" src="${Social.facebookPictureURL(picture)}">
        {{/if}}
        <strong>${name}</strong>
        </a>
        <i>${caption}</i>
        {{if description}}
        <p>${description}</p>
        {{/if}}
      </div>
      {{else}}
      {{if picture}}
      <div>
        <a href="${link}" target="_blank"><img alt="picture" src="${Social.facebookPictureURL(picture)}">
        </a>
      </div>
      {{/if}}
      {{/if}}
    </li>
    {{/if}}
    </script>
    <script id="facebook_album_template" type="text/x-jquery-tmpl">
    {{if type != "friends_walls"}}
    <li>
      <a href="${link}" target="_blank"><img src="https://graph.facebook.com/${id}/picture?type=album" alt="picture"></a>
      <a href="${link}" target="_blank">${name}</a>
      <span>
        {{if count}}
        {{if count == 1}}
        1 photo
        {{else}}
        ${count} photos
        {{/if}}
        {{/if}}
      </span>
    </li>
    {{/if}}
    </script>
    <script>
      // "103882419703669" is Facebook page ID
      // "392120024178056|aqQUlwOblkyuLzKmxZm39SeBVck" is Facebook authentication token
      Social.facebook("405209389537340", "392120024178056|aqQUlwOblkyuLzKmxZm39SeBVck");
    </script>

<?php
    include 'blocks/footer-inner.php';
?>