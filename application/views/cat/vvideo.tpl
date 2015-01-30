<section class="vbox">
    {$navtop}
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        {$aside}
        <!-- /.aside -->
        <section id="content">
          <section class="vbox">
            <section class="scrollable padder-lg">
             
              <h3 class="font-thin m-b">{lang('list')}</h3>
              <div class="row row-sm">
              {foreach $data_song as $k=>$v}
              {$user=$this->ion_auth->user($v.u_id)->row()}
              	<div class="col-xs-6 col-sm-4 col-md-3">
                  <div class="item">
                    <div class="pos-rlt">
                      <div class="item-overlay opacity r r-2x bg-black">
                        <div class="center text-center m-t-n">
                          <a href="{$this->globallib->UrlSong($v.s_id,$v.s_type,$v.s_url)}"><i class="fa fa-play-circle i-2x"></i></a>
                        </div>
                      </div>
                      <a href="{$this->globallib->UrlSong($v.s_id,$v.s_type,$v.s_url)}"><img src="{$this->globallib->images_song($v.s_img)}" alt="{$v.s_name}" style="height:130px;" class="r r-2x img-full"></a>
                    </div>
                    <div class="padder-v">
                      <a href="{$this->globallib->UrlSong($v.s_id,$v.s_type,$v.s_url)}" class="text-ellipsis">{$v.s_name}</a>
                      <a href="{$this->globallib->UrlProfile($v.u_id,$user->username)}" class="text-ellipsis text-xs text-muted">{$user->first_name}&nbsp;{$user->last_name}</a>
                    </div>
                  </div>
                </div>
              {/foreach}
                
                                
              </div>
              {$data_pages}
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
      </section>
    </section>    
  </section>