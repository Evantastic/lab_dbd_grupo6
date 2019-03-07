 

<div class="container">
        <div class="align-content-center">

            <br/>
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Compra realizada
                        <h3><small>Su transacción se ha realizado con exito, a continuación podrá ver los datos de su compra.</small></h3> </h1>
                    <p class="lead">
                        
                        Id de Compra: {{$content->id}}<br/>
                        Compra asociada a: {{$content->user()->first()->email}}<br/>
                        Fecha de Compra: {{$content->created_at}}


                    </p>
                    <h3><small>Recuerde hacer Check-in con su Id de compra el dia de su viaje.</small></h3>
                </div>
            </div>

            <br/><br/>

            <br/><br/>

        </div>
    </div>