<head><meta http-equiv="Content-Type" content="text/html charset=us-ascii">
<style type="text/css">

</style>
</head><body style="word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;" class="">
<div style="padding: 0; width: 100% !important; -webkit-text-size-adjust: 100%; margin: 0; -ms-text-size-adjust: 100%;" marginheight="0" marginwidth="0" class="">
    <table cellpadding="0" cellspacing="0" style="padding: 0; width: 100% !important; background: #FFFFFF; border-radius: 4px; border: 1px #F7F8F8 solid; max-width: 722px; margin: auto; -webkit-border-radius: 4px; background-color: #FFFFFF; -moz-border-radius: 4px;" border="0" align="center" class="">
        <tbody class=""><tr class=""><td align="center" class="">
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="">
    <!--<tbody class=""><tr class=""><td width="1" style="font-size: 0px;" align="center" height="1" class=""><img width="603px" alt="" src="https://cf.dropboxstatic.com/static/images/emails/banners/paper-1.png" height="207px" class=""></td></tr></tbody>-->
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="65%" class=""><tbody class=""><tr class=""><td style="font-size: 0px;" valign="top" align="left" height="65" class=""><img width="210" alt="" src="{{asset('v2/assets/images/feedback.png')}}"class=""></td></tr></tbody>
    </table>
    <table cellpadding="0" cellspacing="0" border="0" width="65%" class="">
        <tbody class=""><tr style="color: #3d454d; font-size: 13px; font-family: Verdana, Geneva, sans-serif; line-height: 21px;" class="">
            <td class=""style="font-size: 15px;">Bonjour {{$user->prenom}},<br class=""><br class="" style="font-size: 15px;">Merci pour l'intérêt que vous portez à Feedback 360.
            <div style="  font-size: 16px;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   letter-spacing: 0.1px;   line-height: 24px;   padding-top: 36px;">Nous partageons avec vous le récapitulatif de vos actions :</div>
            @php $actions = DB::table('actions')->where('agent_id', $user->id)->get();  @endphp
             <div style="  color: #9aa0a6;   display: flex;   font-size: 12px;   letter-spacing: 0.3px;   line-height: 16px;">
              <div style="  padding-top: 12px;">Libellé</div>
              <!--<div>Retard</div>-->
            </div>

                <div style="  padding-top: 12px;">
                    <div style="  display: flex;   font-family: &#39;Google Sans&#39;,Roboto,Arial,sans-serif;   font-size: 14px;   font-weight: 500;   letter-spacing: 0.25px;   line-height: 18px;   min-height: 56px;">
                            <div style="  margin: auto;   margin-left: 0;   padding-right: 14px;   text-align: left;   word-break: break-all;">
                               @foreach($actions as $action)
                              <div><a style="color: inherit;">{{$action->libelle}}</a></div>
                              @endforeach
                            </div>
                            <!--<div style="    border-radius: 8px;   color: #202124;   height: 56px;   line-height: 56px;   margin: auto 0;   min-width: 56px;;     background: #8ab4f8;;">3 jrs</div>-->
                 </div>
                                  </div>