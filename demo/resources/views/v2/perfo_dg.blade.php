

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
                               
                                <span class="text-success">{{intval($ma_semaine_total)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($ma_semaine_total)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
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
                                <span class="text-info">{{intval($somme_total_semaine_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width:{{intval($somme_total_semaine_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
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
                                <h4 class="card-title">Ma performance de la semaine dernière</h4>
                                <div class="text-end">
                                    <!-- <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i> $120</h2>
                                    <span class="text-muted">Todays Income</span> -->
                                </div>
                                <span class="text-success">{{intval($ma_semaine_passe)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($ma_semaine_passe)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Performance de ma Team de la semaine dernière</h4>
                                <!-- <div class="text-end">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-up text-info"></i> $5,000</h2>
                                    <span class="text-muted">Todays Income</span>
                                </div> -->
                                <span class="text-info">{{intval($somme_semaine_passer_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: {{intval($somme_semaine_passer_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
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
                                <span class="text-success">{{intval($somme_total_mois)}}% </span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{intval($somme_total_mois)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
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
                                <span class="text-info">{{intval($somme_total_mois_dir)}}%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width:{{intval($somme_total_mois_dir)}}%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>