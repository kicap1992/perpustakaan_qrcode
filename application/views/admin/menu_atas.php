          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-biik"></i> Buku</span>
              <div class="count"><?=count($list_buku->result())?></div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-list"></i> Kategori</span>
              <div class="count"><?=count($list_kategori->result())?></div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-list-ol"></i> Rak Buku</span>
              <div class="count"><?=count($list_rak_buku->result())?></div>
            </div>

            
          </div>
          <!-- /top tiles -->