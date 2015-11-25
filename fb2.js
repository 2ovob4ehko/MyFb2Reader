$('#file').change(function(event) {
  var tmppath=URL.createObjectURL(event.target.files[0]);
  $('#xml').load(tmppath,function(){
    var title=$(this).find('book-title').html();
    $('#title').html(title);
    $('body').find('.page').each(function(){
      $(this).css('display','block');
    });
  });
  /*$.ajax({
    type: "GET",
    url: tmppath,
    dataType: "xml",
    success: function(xml) {
      var title=$(xml).find('book-title').html();
      var author=$(xml).find('first-name').html()+' '+$(xml).find('last-name').html();
      var cover=$(xml).find('binary').html();
      var genre=[];
      $(xml).find('genre').each(function(){
        genre.push($(this).html());
      });
      genre=genre.join(', ');
      var annotation=$(xml).find('annotation').html();
      var year=$(xml).find('title-info').find('date').html();

      $('#fullcover').attr("src",'data:image/jpeg;base64,'+cover);
      $('#author').html(author);
      $('#title').html(title);
      $('#genre').html(genre);
      jQuery('#genre').html(function(i,val) {
        var f=['sf_cyberpunk','sf_social','prose_contemporary','sf_fantasy','sf_horror','foreign_fantasy','thriller'];
        var r=['кіберпанк фантастика','соціальна фантастика','сучасна проза','фентезі','жах-фантастика','іноземне фентезі','триллер'];
        $.each(f,function(i,v) {
          val = val.replace(new RegExp('\\b' + v + '\\b', 'g'),r[i]);
        });
        return val;
      });
      $('#annotation').html(annotation);
      $('#year').html(year);
      var i=0;
      $('body').find('p').each(function(){
        $(this).attr('title',i);
        $(this).attr('name',i);
        i++;
      });
      $('body').find('.page').each(function(){
        $(this).css('display','block');
      });
      $('#file').css('display','none');
      $(document).scrollTop($("p[name='1']").offset().top);
    },
    error: function(){alert('error');}
  });*/
});
