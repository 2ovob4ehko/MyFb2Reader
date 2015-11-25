$('#file').change(function(event) {
  var tmppath=URL.createObjectURL(event.target.files[0]);
  $.ajax({
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
        var f=['prose_contemporary','sf_fantasy'];
        var r=['сучасна проза','фентезі'];
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
      $(document).scrollTop($("p[name='1']").offset().top);
    },
    error: function(){alert('error');}
  });
});
