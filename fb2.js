var f=['sf_history','sf_action','sf_epic','sf_heroic','sf_detective','sf_cyberpunk','sf_space','sf_social','sf_horror','sf_humor','sf_fantasy','sf','det_classic','det_police','det_action','det_irony','det_history','det_espionage','det_crime','det_political','det_maniac','det_hard','thriller','detective','prose_classic','prose_history','prose_contemporary','prose_counter','prose_rus_classic','prose_su_classics','love_contemporary','love_history','love_detective','love_short','love_erotica','adv_western','adv_history','adv_indian','adv_maritime','adv_geo','adv_animal','adventure','child_tale','child_verse','child_prose','child_sf','child_det','child_adv','child_education','children','poetry','dramaturgy','antique_ant','antique_european','antique_russian','antique_east','antique_myths','antique','sci_history','sci_psychology','sci_culture','sci_religion','sci_philosophy','sci_politics','sci_business','sci_juris','sci_linguistic','sci_medicine','sci_phys','sci_math','sci_chem','sci_biology','sci_tech','science','comp_www','comp_programming','comp_hard','comp_soft','comp_db','comp_osnet','computers','ref_encyc','ref_dict','ref_ref','ref_guide','reference','nonf_biography','nonf_publicism','nonf_criticism','design','nonfiction','religion_rel','religion_esoterics','religion_self','religion','humor_anecdote','humor_prose','humor_verse','humor','home_cooking','home_pets','home_crafts','home_entertain','home_health','home_garden','home_diy','home_sport','home_sex','home','foreign_fantasy'];
var r=['Альтернативна історія','Бойова фантастика','Епічна фантастика','Героїчна фантастика','Детективна фантастика','Кіберпанк','Космічна фантастика','Соціально-психологічна фантастика','Жахи і Містика','Гумористична фантастика','Фентезі','Наукова фантастика','Класичний детектив','Поліцейський детектив','Бойовик','Іронічний детектив','Історичний детектив','Шпигунський детектив','Кримінальний детектив','Політичний детектив','Маніяки','Крутой детектив','Триллер','Детектив','Класична проза','Історична проза','Сучасна проза','Контркультура','Російська класична проза','Радянська класична проза','Сучасні любовні романи','Історичні любовні романи','Гостросюжетні любовні романи','Короткі любовні романи','Еротика','Вестерн','Історичні пригоди','Пригоди про індіанців','Морські пригоди','Подорожі та географія','Природа і тварини','Інші пригоди','Казка','Дитячі вірші','Дитяча проза','Дитяча фантастика','Дитячі гостросюжетні','Дитячі пригоди','Дитяча освітня література','Інша дитяча література','Поезія','Драматургія','Антична література','Європейська старовинна література','Давньоруська література','Давньосхідна література','Міфи. Легенди. Епос','Інша старовинна література','Історія','Психологія','Культурологія','Релігієзнавство','Філософія','Політика','Ділова література','Юриспруденція','Мовознавство','Медицина','Фізика','Математика','Хімія','Біологія','Технічні науки','Інша наукова література','Інтернет','Програмування','Комп’ютерне "залізо"','Програми','Бази даних','ОС і Мережі','Інша комп’ютерна література','Енциклопедії','Словники','Довідники','Керівництва','Інша довідкова література','Біографії та Мемуари','Публіцистика','Критика','Мистецтво і Дизайн','Інша документальна література','Релігія','Езотерика','Самовдосконалення','Інша релігіоная література','Анекдоти','Гумористична проза','Гумористичні вірші','Інший гумор','Кулінарія','Домашні тварини','Захоплення і ремесла','Розваги','Здоров’я','Сад і город','Зроби сам','Спорт','Еротика, Секс','Інше домоведення','Іноземне фентезі'];
$('#file').change(function(event) {
  var tmppath=URL.createObjectURL(event.target.files[0]);
  var req=createCORSRequest("get",tmppath);
  if(req){
    req.onload=function(){
      var title=$(req.responseText).find('book-title').html();
      var author=$(req.responseText).find('first-name').html()+' '+$(req.responseText).find('last-name').html();
      var cover=$(req.responseText).find('binary').html();
      var genre=[];
      $(req.responseText).find('genre').each(function(){
        genre.push($(this).html());
      });
      genre=genre.join(', ');
      var annotation=$(req.responseText).find('annotation').html();
      var year=$(req.responseText).find('title-info').find('date').html();

      $('#fullcover').attr("src",'data:image/jpeg;base64,'+cover);
      $('#author').html(author);
      $('#title').html(title);
      $('#genre').html(genre);
      $('#genre').html(function(i,val){
        $.each(f,function(i,v){
          val = val.replace(new RegExp('\\b' + v + '\\b', 'g'),r[i]);
        });
        return val;
      });
      $('#annotation').html(annotation);
      $('#year').html(year);
      $(req.responseText).children('section').each(function(){
        var attr = $(this).attr('id');
        if (typeof attr==typeof undefined || attr==false){
          var page=$('<div class="page">'+$(this).html()+'</div>');
          $('body').append(page);
          page.children('title:first').replaceWith('<h2>'+page.children('title:first').text()+'</h2>');
          page.children('section').each(function(){
            var subtitle=$(this);
            subtitle.children('title:first').replaceWith('<h2>'+subtitle.children('title:first').text()+'</h2>');
          });
        }
      });
      $('body').append('<div class="page" id="notes"></div>');
      $(req.responseText).children("section[id]").each(function(){
        var note=$(this);
        $('#notes').append(note);
        $('#notes').css('display','block');
        note.children('title').replaceWith('</div><h2 name="#'+note.attr('id')+'">'+note.children('title').text()+'</h2><div id="up_button">');
      });
      var i=0;
      $('body').find('p').each(function(){
        $(this).attr('title',i);
        $(this).attr('name',i);
        i++;
      });
      $('body').on('click','p',function(){
        $.ajax({
          url:"?action=save&title="+title+"&author="+author+"&line="+$(this).attr('name'),
          cache:false
        });
      });
      $.ajax({
        url:"?action=line&title="+title+"&author="+author,
        cache:false,
        success:function(result){
          var line=parseInt(result);
          if(line!=0){
            $(document).scrollTop($("p[name='"+line+"']").offset().top);
            console.log(line);
          }
        }
      });
      $('body').find('.page[id!="notes"]').each(function(){
        $(this).css('display','block');
      });
      $('#file').css('display','none');
      $(document).on('click',"a[type='note']",function(){
        $(document).scrollTop($("h2[name='"+$(this).attr('l:href')+"']").offset().top);
      });
      $(document).on('click',"#up_button",function(){
        $(document).scrollTop($("a[l\\:href='#"+$(this).parent().attr('id')+"']").offset().top);
      });
    };
    req.send();
  }
});
function createCORSRequest(method,url){
  var xhr = new XMLHttpRequest();
  if("withCredentials" in xhr){
    xhr.open(method,url,true);
  }else if(typeof XDomainRequest != "undefined"){
    xhr = new XDomainRequest();
    xhr.open(method,url);
  }else{
    xhr=null;
  }
  return xhr;
}
