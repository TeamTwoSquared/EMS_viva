@php
    use App\Http\Controllers\ad\AdsController;
    use App\Http\Controllers\ad\AdImagesController;

    $rightAds = AdsController::getRightAds();

@endphp
<div class="col-md-3 shadow-sm" data-pg-collapsed>
    @foreach($rightAds as $rightAd)
    @php
        $randomImage=AdImagesController::getRightRandomImages($rightAd->ad_id); 
        AdsController::impressionInc($rightAd->ad_id);
    @endphp
        <div class="row">
            @if($rightAd->ad_url==NULL)
                <a href="/client/view/svp/{{$rightAd->service_provider_id}}" onclick ="incRight({{$rightAd->ad_id}})" target="_blank"> <img src="/storage/images/ad/{{$randomImage->imgurl}}"/> </a>
            @else
                <a href="{{$rightAd->ad_url}}" onclick ="incRight({{$rightAd->ad_id}})" target="_blank"> <img src="/storage/images/ad/{{$randomImage->imgurl}}"/> </a>
            @endif
        </div>
        <hr/>
    @endforeach
<script>
    function incRight(id){
        $.ajax({
            type:'GET',
            url:'/svp/ads/clickinc/'+id,
        });
    }
</script>
</div>