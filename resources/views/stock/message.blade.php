
    @if (session()->has('success'))

        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            {{session('success')}}
        </div>
    

    @endif

        @if (session()->has('flash'))

            <div class="alert alert-warning alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{session('flash')}}
            </div>
        
        @endif
        
        @if (session()->has('error'))

            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{session('error')}}
            </div>
            
        @endif
