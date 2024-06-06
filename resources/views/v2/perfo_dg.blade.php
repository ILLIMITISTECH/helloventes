                <!-- ==============================  Performances ================================ -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ma performance de la semaine</h4>
                                <div class="text-end">
                                    <!-- <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> $120</h2>
                                    <span class="text-muted">Todays Income</span> -->
                                </div>
                               @if(intval($ma_semaine_total) >= 80)
                                <span class="text-success">{{intval($ma_semaine_total)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($ma_semaine_total)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($ma_semaine_total) >= 50)
                                <span class="text-warning">{{intval($ma_semaine_total)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{intval($ma_semaine_total)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($ma_semaine_total) < 50)
                                <span class="text-danger">{{intval($ma_semaine_total)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{intval($ma_semaine_total)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                               
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Performance de ma Team</h4>
                                <!-- <div class="text-end">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                                    <span class="text-muted">Todays Income</span>
                                </div> -->
                                @if(intval($somme_total_semaine_dir) >= 80)
                                <span class="text-success">{{intval($somme_total_semaine_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($somme_total_semaine_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($somme_total_semaine_dir) >= 50)
                                <span class="text-warning">{{intval($somme_total_semaine_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{intval($somme_total_semaine_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($somme_total_semaine_dir) < 50)
                                <span class="text-danger">{{intval($somme_total_semaine_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{intval($somme_total_semaine_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ma performance de la semaine passée</h4>
                                <div class="text-end">
                                    <!-- <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> $120</h2>
                                    <span class="text-muted">Todays Income</span> -->
                                </div>
                                @if(intval($action_sem_pass->sommes) >= 80)
                                <span class="text-success">{{intval($action_sem_pass->sommes)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($action_sem_pass->sommes)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($action_sem_pass->sommes) >= 50)
                                <span class="text-warning">{{intval($action_sem_pass->sommes)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{intval($action_sem_pass->sommes)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($action_sem_pass->sommes) < 50)
                                <span class="text-danger">{{intval($action_sem_pass->sommes)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{intval($action_sem_pass->sommes)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Performance de ma Team de la semaine passée</h4>
                                <!-- <div class="text-end">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                                    <span class="text-muted">Todays Income</span>
                                </div> -->
                                @if(intval($somme_semaine_passer_dir) >= 80)
                                <span class="text-success">{{intval($somme_semaine_passer_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($somme_semaine_passer_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($somme_semaine_passer_dir) >= 50)
                                <span class="text-warning">{{intval($somme_semaine_passer_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{intval($somme_semaine_passer_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($somme_semaine_passer_dir) < 50)
                                <span class="text-danger">{{intval($somme_semaine_passer_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{intval($somme_semaine_passer_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                 <!-- ==============================  Performances  ================================ -->

                 <!-- ==============================  Performances du mois  ================================ -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Ma performance du mois </h4>
                                <div class="text-end">
                                    <!-- <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> $120</h2>
                                    <span class="text-muted">Todays Income</span> -->
                                </div>
                                @if(intval($somme_total_mois) >= 80)
                                <span class="text-success">{{intval($somme_total_mois)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($somme_total_mois)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($somme_total_mois) >= 50)
                                <span class="text-warning">{{intval($somme_total_mois)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{intval($somme_total_mois)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($somme_total_mois) < 50)
                                <span class="text-danger">{{intval($somme_total_mois)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{intval($somme_total_mois)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                               
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Performance de ma Team du mois</h4>
                                <!-- <div class="text-end">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                                    <span class="text-muted">Todays Income</span>
                                </div> -->
                                @if(intval($somme_total_mois_dir) >= 80)
                                <span class="text-success">{{intval($somme_total_mois_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($somme_total_mois_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($somme_total_mois_dir) >= 50)
                                <span class="text-warning">{{intval($somme_total_mois_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{intval($somme_total_mois_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @elseif(intval($somme_total_mois_dir) < 50)
                                <span class="text-danger">{{intval($somme_total_mois_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{intval($somme_total_mois_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                                @endif
                               
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>