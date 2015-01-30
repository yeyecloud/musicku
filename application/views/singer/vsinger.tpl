<section class="vbox">
  {$navtop}
  <section>
    <section class="hbox stretch">
      <!-- .aside -->
      {$aside}
      <!-- /.aside -->
      <section id="content">
        <section class="vbox">
          <section class="scrollable">
            <section class="hbox stretch">
              <aside class="aside-lg bg-dark lter b-r b-black">
                <section class="vbox">
                  <section class="panel bg-dark lt">
                    <div class="panel-body">
                      <div class="clearfix text-center m-t">
                        <div class="inline">
                          <div class="easypiechart easyPieChart" data-percent="75" data-line-width="5" data-bar-color="#4cc0c1" data-track-color="#f5f5f5" data-scale-color="false" data-size="134" data-line-cap="butt" data-animate="1000" style="width: 134px; height: 134px; line-height: 134px;">
                            <div class="thumb-lg">
                              <img src="{$this->globallib->ImgSinger($data_singer['si_img'])}" style="height:128px;" class="img-circle thumb-lg" alt="{$data_singer['si_name']}">
                            </div>
                          <canvas width="134" height="134"></canvas></div>
                          <div class="h4 m-t m-b-xs">{$data_singer['si_name']}</div>
                          <small class="text-muted m-b">Ngày sinh:{$data_singer['si_birthday']}</small>
                        </div>                      
                      </div>
                    </div>
                    <footer class="panel-footer bg-dark dk text-center b-black">
                      <div class="row pull-out">
                        <div class="col-xs-4">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white">{$count_song_audio+$count_song_video}</span>
                            <small class="text-muted">{lang('total')}</small>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white">{$count_song_audio}</span>
                            <small class="text-muted">{lang('audio')}</small>
                          </div>
                        </div>
                        <div class="col-xs-4">
                          <div class="padder-v">
                            <span class="m-b-xs h3 block text-white">{$count_song_video}</span>
                            <small class="text-muted">{lang('video')}</small>
                          </div>
                        </div>
                      </div>
                    </footer>
                  </section>
                </section>
              </aside>
              <aside class="bg-dark">
                <section class="vbox">
                  <header class="header bg-dark lt">
                    <ul class="nav nav-tabs nav-dark lter">
                      <li class="active"><a href="#activity" data-toggle="tab">{lang('information')}</a>
                      </li>
                      <li class=""><a href="#audio" data-toggle="tab">{lang('audio')}</a>
                      </li>
                      <li class=""><a href="#interaction" data-toggle="tab">{lang('video')}</a>
                      </li>
                    </ul>
                  </header>
                  <section class="scrollable">
                    <div class="tab-content">
                      <div class="tab-pane active" id="activity">
                        <ul class="list-group no-radius list-group-xs no-bg auto m-b-none m-t-n-xxs">
                          
                          <li class="list-group-item">
                          <label>{lang('singer_name')}</label>
                            <strong class="block">{$data_singer['si_name']}</strong>
                          </li>
                          
                          <li class="list-group-item">
                          <label>{lang('singer_birthday')}</label>
                            <strong class="block">{$data_singer['si_birthday']}</strong>
                          </li>
                          
                          <li class="list-group-item">
                          <label>{lang('description')}</label>
                            <strong class="block">{$data_singer['si_description']}</strong>
                          </li>
                        </ul>
                      </div>
                      <div class="tab-pane" id="audio">
                        <ul class="list-group no-radius list-group-xs no-bg auto m-b-none m-t-n-xxs">
                        {foreach $data_song_audio as $k=>$v}
                          <li class="list-group-item clearfix">
                          	<a href="{$this->globallib->UrlSong($v.s_id,$v.s_type,$v.s_url)}" title="{$v.s_name}" class="pull-left thumb-sm m-r">
                              <img src="{$this->globallib->images_song($v.s_img)}" style="height: 40px;" alt="{$v.s_name}">
                            </a>
                            <a class="clear" href="{$this->globallib->UrlSong($v.s_id,$v.s_type,$v.s_url)}" title="{$v.pl_name}">
                              <span class="block text-ellipsis">{$v.s_name}</span>
                              <small>{date('Y-m-d',$v.s_date_creat)}</small>
                            </a>
                          </li>
                         {/foreach}
                        </ul>
                      </div>
                      <div class="tab-pane" id="interaction">
                        <ul class="list-group no-radius list-group-xs no-bg auto m-b-none m-t-n-xxs">
                        {foreach $data_song_video as $k=>$v}
                          <li class="list-group-item clearfix">
                          	<a href="{$this->globallib->UrlSong($v.s_id,$v.s_type,$v.s_url)}" title="{$v.s_name}" class="pull-left thumb-sm m-r">
                              <img src="{$this->globallib->images_song($v.s_img)}" style="height: 40px;" alt="{$v.s_name}">
                            </a>
                            <a class="clear" href="{$this->globallib->UrlSong($v.s_id,$v.s_type,$v.s_url)}" title="{$v.pl_name}">
                              <span class="block text-ellipsis">{$v.s_name}</span>
                              <small>{date('Y-m-d',$v.s_date_creat)}</small>
                            </a>
                          </li>
                         {/foreach}
                        </ul>
                      </div>
                    </div>
                  </section>
                </section>
              </aside>
              
            </section>
          </section>
        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
      </section>
    </section>
  </section>
</section>