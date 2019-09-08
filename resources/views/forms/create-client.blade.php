<form role="form" class="newClientForm">
        {{ csrf_field() }}
          <div class="form-row form-group">
            <div class="col">
              <label for="name">Nombre</label>
              <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre">
            </div>
            <div class="col">
              <label for="lastname">Apellido</label>
              <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Apellido">
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo Electronico">
            </div>
            <div class="col">
              <label for="dniType">Tipo de documento</label>
              <select name="dniType" id="dniType" class="form-control input-sm">
                  <option value="IFE">IFE</option>
                  <option value="FMM">FMM</option>
                  <option value="Pasaporte">Pasaporte</option>
              </select>
            </div>
            <div class="col">
              <label for="dni">Numero de documento</label>
              <input type="text" name="dni" id="dni" class="form-control input-sm" placeholder="Numero de documento">
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="fiscalname">Nombre Fiscal</label>
              <input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" placeholder="Nombre Fiscal">
            </div>
            <div class="col">
              <label for="commercialname">Nombre Comercial</label>
              <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" placeholder="Nombre Comercial">
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="phone">Telefono</label>
              <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono">
            </div>
            <div class="col">
                <label for="rfc">RFC</label>
                <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC">
              </div>
          </div>
          <div class="form-row text-center">
              <h4 class="text-center">Datos de dirección</h4>
          </div>
          <div class="form-row form-group">
              <div class="col">
                <label>Ingrese ciudad o estado</label>
                <input type="text" class="my-input form-control input-sm" placeholder="Buscar por ciudad o estado" autocomplete="off">
              </div>
          </div>
          <div class="form-row form-group">
                <div class="col">
                  <label for="city">Ciudad</label>
                  <input type="text" name="city" id="city"  class="form-control input-sm" placeholder="Ciudad">
                </div>
                <div class="col">
                  <label for="state">Estado</label>
                  <input type="text" name="state" id="state" class="form-control input-sm" placeholder="Estado">
               </div>
              </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="number">Numero de casa</label>
              <input type="text" name="number" id="number" class="form-control input-sm" placeholder="Numero de casa/Departamento">
            </div>
            <div class="col">
                <label for="street">Calle</label>
                <input type="text" name="street" id="street" class="form-control input-sm" placeholder="Calle">
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="colony">Colonia</label>
              <input type="text" name="colony" id="colony" class="form-control input-sm" placeholder="Colonia">
            </div>
            <div class="col">
                <label for="postalCode">Código postal</label>
                <input type="number" name="postalCode" id="postalCode" class="form-control input-sm" placeholder="Codigo Postal">
            </div>
          </div>
          <div class="form-group form-row">
            <div class="col">
              <a href="#" class="btn btn-info btn-block clientFormClose" >Cerrar</a>
            </div>
            <div class="col">
              <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
            </div>
          </div>
        </form>
