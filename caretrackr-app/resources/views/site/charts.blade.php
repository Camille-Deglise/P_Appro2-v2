<div class="charts">

    <div class="temp-chart">

        {!! $tempchart->container() !!}
        
        {!! $tempchart->script() !!} 
    </div>
    <div class='sat-chart'>

        {!! $satchart->container() !!}
        
        {!! $satchart->script() !!} 
    </div>
    <div class="pulse-chart">

        {!! $pulsechart->container() !!}
        
        {!! $pulsechart->script() !!} 
    </div>
    <div class="bs-chart">

        {!! $bschart->container() !!}
        
        {!! $bschart->script() !!} 
    </div>
    <div class="tens-chart">

        {!! $tenschart->container() !!}
        
        {!! $tenschart->script() !!}  
    </div>
    
</div>
