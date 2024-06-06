    @php 
    $commercial = App\Commerciau::where('user_id', Auth::user()->id)->first();
    $entreprise = DB::table('prospects')->where('commercial_id', $commercial->id)->get();
    $opportunite = DB::table('opportunites')->where('commercial_id', $commercial->id)->get();
    @endphp
<div class="form-group" style="display:flex;">
                            
                            <div class="form-control">
                             <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Libellé (<span style=" color:red;">*</span>)
                                </span>
                            </label>
                           <input  name="libelle" type="text" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                            style="width:400px; "  />
                            </div>
                            <div class="form-control">
                                  @php
                                        $today = date('Y-m-d');
                                  @endphp
                                      <label class="block text-sm" style="margin-left:50px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                          Date (<span style=" color:red;">*</span>)
                                        </span> 
                                        <input  name="date" type="date" value="{{$today}}" 
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-green-400 focus:outline-none focus:shadow-outline-green form-input"
                                            style="width:400px; "  />
                                    </label>
                            </div>
                            <!--<div class="form-control">-->
                            <!-- <label class="block text-sm" style="margin-left:50px;">-->
                            <!--    <span class="text-gray-700 dark:text-gray-400">-->
                            <!--        c’est une sortie terrain ?-->
                            <!--    </span >-->
                            <!--</label>-->
                            <!--<select id="country" name="type" -->
                            <!--    class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input form-control" style="width:400px; margin-left:50px;">-->
                            <!--    <option value="oui">Oui</option>-->
                            <!--     <option value="non">Non</option>-->
                               
                            <!--</select>-->
                            <!--</div>-->
                            
                        </div>
                    
                        <div class="form-group" style="display:flex;">
                            
                            <div class="form-control">
                             <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Prospect (<span style=" color:red;">*</span>)
                                </span>
                            </label>
                            <select id="country" name="prospect_id" required
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input form-control" style="width:400px;">
                                <option value="" >Selectionner le prospect</option>
                                @foreach($entreprise as $prospects)
                                    <option value="{{$prospects->id}}">{{$prospects->nom_entreprise}}</option>
                                @endforeach
                            </select>
                            </div>
                            
                            <div class="form-control">
                                    <label class="block text-sm" style="margin-left:50px;">
                                        <span class="text-gray-700 dark:text-gray-400">
                                            Heure 
                                        </span> (<span style=" color:red;">*</span>)
                                        <input type="time" name="heure_debut" required
                                            class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                                            placeholder="DD/MM/YYYY" style="width:400px;" />
                                    </label>
                            </div>
                            
                        </div>
                        
                          <br>
                        <div class="form-group" style="display:flex;">
                            
                            
                             <div class="form-control">
                             <label class="block text-sm" >
                                <span class="text-gray-700 dark:text-gray-400">
                                    Opportunité
                                </span >
                            </label>
                            <select id="country" name="opportunite_id" 
                                class="block w-full mt-1 text-sm border-gray-600 dark:text-gray-300 dark:bg-gray-700 focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input form-control" style="width:400px; ">
                                <option value="" disabled selected >Selectionner l'opportunite</option>
                                @foreach($opportunite as $opportunites)
                                    <option value="{{$opportunites->id}}">{{$opportunites->libelle}}</option>
                                @endforeach
                            </select>
                            </div>
                              
                           
                            
                                    
                        
                        </div>