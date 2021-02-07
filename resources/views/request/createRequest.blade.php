<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calcula tu gasto energético') }}
        </h2>
    </x-slot>

    <div class="row mx-auto container sm:px-6 mt-10 pb-10 lg:px-8">
        <form action="{{url('enviar-solicitud')}}" method="post" onchange="calculo();" class="col-md overflow-hidden shadow-sm sm:rounded-lg">
            @csrf

            @if($errors->any())
                <br>
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">1. Tu dirección</h3>
                <div class="form-group mt-5">
                    <label for="street">Calle</label><br>
                    <input type="text" class="form-control w-full" id="street" name="street" value="{{old('street')}}">
                </div>

                <div class="form-group flex mt-2 justify-between">
                    <div class="w-1/5 mt-5">
                        <label for="cp">C.P.</label><br>
                        <input type="number" class="form-control w-full" id="cp" name="cp" value="{{old('cp')}}">
                    </div>    
                    <div class="w-1/5 mt-5">
                        <label for="city">Ciudad</label><br>
                        <input type="text" class="form-control w-full" id="city" name="city" value="{{old('city')}}">
                    </div> 
                    <div class="w-1/5 mt-5">
                        <label for="state">Provincia</label><br>
                        <input type="text" class="form-control w-full" id="state" name="state" value="{{old('state')}}">
                    </div>
                    <div class="w-1/5 mt-5">
                        <label for="country">País</label><br>
                        <input type="text" class="form-control w-full" id="country" name="country" value="{{old('country')}}">
                    </div> 
                </div>
            </div>

            <div class="p-6 bg-white mt-5 border-b border-gray-200">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">2. Tu consumo</h3>

                <div class="form-group flex mt-2 justify-between">
                    <div class="w-2/5 mt-5">
                        <label for="pago_mensual">¿Cuánto pagas mensualmente?</label><br>
                        <input type="number" class="form-control w-full" id="pago_mensual" name="pago_mensual" value="{{old('pago_mensual')}}">
                    </div>    
                    <div class="w-2/5 mt-5">
                        <label for="potencia_contratada">¿Cuántos sois en casa?</label><br>
                        <select class="form-control w-full" id="potencia_contratada" name="potencia_contratada">
                            <option value="3.45">1</option>
                          <option value="4">2</option>
                          <option value="4.6">3</option>
                          <option value="5">4</option>
                          <option value="5.75">5</option>
                        </select>
                    </div> 
                </div>
            </div>

            <div class="p-6 bg-white mt-5 border-b border-gray-200">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight">3. Tus datos</h3>

                <div class="form-group flex mt-2 justify-between flex-wrap">
                    <div class="w-2/5 mt-5">
                        <label for="name">Nombre</label><br>
                        <input type="text" class="form-control w-full" id="name" name="name" value="{{old('name')}}">
                    </div>    
                    <div class="w-2/5 mt-5">
                        <label for="surname">Apellido</label><br>
                        <input type="text" class="form-control w-full" id="surname" name="surname" value="{{old('surname')}}">
                    </div>
                    <div class="w-2/5 mt-5">
                        <label for="phone">Teléfono móvil</label><br>
                        <input type="tel" class="form-control w-full" id="phone" name="phone" value="{{old('phone')}}">
                    </div> 
                    <div class="w-2/5 mt-5">
                        <label for="email">e-mail</label><br>
                        <input type="email" class="form-control w-full" id="email" name="email" value="{{old('email')}}">
                    </div> 
                </div>
            </div>

            <div class="p-6 bg-white mt-5 border-b border-gray-200">
                <h3 class="font-semibold text-xl text-gray-800 leading-tight text-center">Tu cálculo</h3>

                <div class="form-group flex mt-2 justify-between flex-wrap">
                    <div class="w-2/5 mt-5">
                        <label for="potencia_instalada">Potencia Instalada (kWp)</label><br>
                        <input type="text" class="form-control w-full" id="potencia_instalada" name="potencia_instalada" readonly>
                    </div>    
                    <div class="w-2/5 mt-5">
                        <label for="numero_paneles">Número paneles</label><br>
                        <input type="number" class="form-control w-full" id="numero_paneles" name="numero_paneles" readonly="true">
                    </div>
                    <div class="w-2/5 mt-5">
                        <label for="superficie_necesaria">Superficie Necesaria (m2)</label><br>
                        <input type="number" class="form-control w-full" id="superficie_necesaria" name="superficie_necesaria" readonly="true">
                    </div> 
                    <div class="w-2/5 mt-5">
                        <label for="ahorro_anual">Ahorro anual estimado</label><br>
                        <input type="number" class="form-control w-full" id="ahorro_anual" name="ahorro_anual" readonly="true">
                    </div> 
                    <div class="w-2/5 mt-5">
                        <label for="co2_evitado">CO2 total evitado</label><br>
                        <input type="number" class="form-control w-full" id="co2_evitado" name="co2_evitado" readonly="true">
                    </div>
                    <div class="w-2/5 mt-5">
                        <label for="arboles_plantados">Árboles plantados</label><br>
                        <input type="number" class="form-control w-full" id="arboles_plantados" name="arboles_plantados" readonly>
                    </div>  
                </div>
            </div>

            <button type="submit" class="mt-6 btn px-3 py-2 btn-success bg-green-300 w-full text-white">Finalizar</button>
        </form>
    </div>

</x-app-layout>