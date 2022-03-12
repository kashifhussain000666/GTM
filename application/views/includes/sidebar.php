
<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center p-4"><img class="avatar shadow-0 img-fluid rounded-circle" src="<?=$this->config->base_url()?>asset/img/avatar.jpg" alt="...">
          <div class="ms-3 title">
            <h1 class="h5 mb-1"><?=$this->session->userdata('user_name')?></h1>
            <!-- <p class="text-sm text-gray-700 mb-0 lh-1">Web Designer</p> -->
          </div>
        </div><!-- <span class="text-uppercase text-gray-600 text-xs mx-3 px-2 heading mb-2">Main</span> -->
        <ul class="list-unstyled">
              <li class="sidebar-item <?php if($this->uri->segment(1) == 'home'){ ?>active<?php }?>"><a class="sidebar-link" href="<?=$this->config->base_url()?>home"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                        <use xlink:href="#real-estate-1"> </use>
                      </svg><span>Home </span></a></li>
              <li class="sidebar-item <?php if($this->uri->segment(1) == 'Leaderboard'){ ?>active<?php }?>"><a class="sidebar-link" href="<?=$this->config->base_url()?>Leaderboard"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                         <use xlink:href="#quality-1"> </use>
                      </svg><span>Leaderboard </span></a></li>
              <li class="sidebar-item <?php if($this->uri->segment(1) == 'LeagueSchedule'){ ?>active<?php }?>"><a class="sidebar-link" href="<?=$this->config->base_url()?>LeagueSchedule"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                         <use xlink:href="#browser-window-1"> </use>
                      </svg><span>League Schedule </span></a></li>
              <li class="sidebar-item "><a class="sidebar-link" href="#exampledropdownDropdown" data-bs-toggle="collapse"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                        <use xlink:href="#browser-window-1"> </use>
                      </svg><span>Account </span></a>
                <ul class="collapse list-unstyled <?php if($this->uri->segment(1) == 'update'){ ?>collapse show<?php }?>" id="exampledropdownDropdown">
                  <li class="sidebar-item <?php if($this->uri->segment(1) == 'update'){ ?>active<?php }?>"><a class="sidebar-link" href="<?=$this->config->base_url()?>update">Update Account</a></li>
                 
                </ul>
              </li>
              <?php 
              if($this->uri->segment(1) == 'home'){ ?>

               <li class="sidebar-item "><a class="sidebar-link" href="#exampledropdownDropdown1" data-bs-toggle="collapse"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                        <use xlink:href="#browser-window-1"> </use>
                      </svg><span>Filters </span></a>
                <ul class="collapse list-unstyled <?php if($this->uri->segment(1) == 'home'){ ?>collapse show<?php }?>" id="exampledropdownDropdown1">
                 <!--  <li class="sidebar-item <?php if($this->uri->segment(1) == 'home'){ ?>active<?php }?>"><a class="sidebar-link" href="<?=$this->config->base_url()?>update">Update Account</a></li> -->
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-12"><br>
                              <div class="form-check  ">
                                 <label class="form-check-label" for="chk_division_0"><b>Filter By User</b></label>
                              </div>
                              <div class="form-check"> 
                               <input type="text" value="" class="form-control" name="user_name" id="user_name" onkeyup="CheckAllDivision(this)"> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><br><br>
                    <div class="row ">
                      <div class="col-md-12"><!-- <h3 class="form-check">Filters</h3> -->
                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-check  ">
                                  <input class="devision_chk_box" onclick="CheckAllDivision(this)" divisionID='0'  value='0' class="form-check-input" id="chk_division_0" type="checkbox" >
                                  <label class="form-check-label" for="chk_division_0"><h4>Divisions</h4></label>
                              </div>
                              <div class="home-division-filter-div"> 
                               
                                
                              <?php
                              foreach($divisionlist as $division)
                              {
                              ?>
                              <div class="form-check  mt-2">
                               
                                  <input class="devision_chk_box" onclick="GetDevisionFilterResult(this)" divisionID='<?=$division['id']?>'  value='<?=$division['id']?>' class="form-check-input" id="chk_division_<?=$division['id']?>" type="checkbox" >
                                  <label class="form-check-label" for="chk_division_<?=$division['id']?>"><?=$division['divisionname']?></label>
                                
                              </div>
                              <?php 
                              } ?> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><br><br>
                    <div class="row">
                      <div class="col-md-12"><!-- <h3 class="form-check">Filters</h3> -->
                        <div class="row">
                          <div class="col-md-12">
                              <div class="form-check  ">
                                  <input class="event_chk_box" onclick="CheckAllEvent(this)" divisionID='0'  value='0' class="form-check-input" id="chk_event_0" type="checkbox" >
                                  <label class="form-check-label" for="chk_division_0"><h4>All Events</h4></label>
                                </div>
                              <div class="home-division-filter-div"> 
                                
                                
                              <?php
                              foreach($eventdetails as $event)
                              {
                              ?>
                              <div class="form-check  mt-2">
                               
                                  <input class="event_chk_box" onclick="GetEventResult(this)" divisionID='<?=$event['id']?>'  value='<?=$event['id']?>' class="form-check-input" id="chk_event_<?=$event['id']?>" type="checkbox" >
                                  <label class="form-check-label" for="chk_event_<?=$event['id']?>"><?=$event['eventname']?></label>
                                
                              </div>
                              <?php 
                              } ?> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                 
                </ul>
              </li>
              <?php
              } ?>

               <?php 
              if($this->uri->segment(1) == 'Leaderboard'){ ?>

               <li class="sidebar-item "><a class="sidebar-link" href="#exampledropdownDropdown2" data-bs-toggle="collapse"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                        <use xlink:href="#browser-window-1"> </use>
                      </svg><span>Filters </span></a>
                <ul class="collapse list-unstyled <?php if($this->uri->segment(1) == 'Leaderboard'){ ?>collapse show<?php }?>" id="exampledropdownDropdown2">
                 <!--  <li class="sidebar-item <?php if($this->uri->segment(1) == 'Leaderboard'){ ?>active<?php }?>"><a class="sidebar-link" href="<?=$this->config->base_url()?>update">Update Account</a></li> -->
                  <div class="col-md-12">
                    
                    <div class="row ">
                      <div class="col-md-12"><!-- <h3 class="form-check">Filters</h3> -->
                        <div class="row">
                          <div class="col-md-12"><br>
                              <div class="form-check  ">
                                  <input class="devision_chk_box" onclick="CheckAllDivision(this)" divisionID='0'  value='0' class="form-check-input" id="chk_division_0" type="checkbox" >
                                  <label class="form-check-label" for="chk_division_0"><h4>Divisions</h4></label>
                              </div>
                              <div class="home-division-filter-div"> 
                               
                                
                              <?php
                              foreach($divisionlist as $division)
                              {
                              ?>
                              <div class="form-check  mt-2">
                               
                                  <input class="devision_chk_box" onclick="GetDevisionResult(this)" divisionID='<?=$division['id']?>'  value='<?=$division['id']?>' class="form-check-input" id="chk_division_<?=$division['id']?>" type="checkbox" >
                                  <label class="form-check-label" for="chk_division_<?=$division['id']?>"><?=$division['divisionname']?></label>
                                
                              </div>
                              <?php 
                              } ?> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>

                 
                </ul>
              </li>
              <?php
              } ?>

           
           
           
             
           
        </ul>
      </nav>