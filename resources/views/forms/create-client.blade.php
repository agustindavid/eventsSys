<form role="form" class="newClientForm">
        {{ csrf_field() }}
          <div class="form-row form-group">
            <div class="col-xs col-md-6">
              <label for="name">Nombre <span class="reqStar">*</span></label>
              <input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre" required>
            </div>
            <div class="col-xs col-md-6">
              <label for="lastname">Apellido <span class="reqStar">*</span></label>
              <input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="Apellido" required>
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col-md-4 col-xs mb1r">
              <label for="email">Email <span class="reqStar">*</span></label>
              <input type="text" name="email" id="email" class="form-control input-sm" placeholder="Correo Electronico" required>
            </div>
            <div class="col-md-4 col-xs mb1r">
              <label for="dniType">Tipo de documento <span class="reqStar">*</span></label>
              <select name="dniType" id="dniType" class="form-control input-sm" required>
                  <option value="">Seleccione un tipo de documento</option>
                  <option value="IFE">IFE</option>
                  <option value="FMM">FMM</option>
                  <option value="Pasaporte">Pasaporte</option>
              </select>
            </div>
            <div class="col-md-4 col-xs">
              <label for="dni">Numero de documento <span class="reqStar">*</span></label>
              <input type="text" name="dni" id="dni" class="form-control input-sm" placeholder="Numero de documento" required>
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col-md-4 col-xs mb1r">
              <label for="fiscalname">Nombre Fiscal</label>
              <input type="text" name="fiscalname" id="fiscalname" class="form-control input-sm" placeholder="Nombre Fiscal">
            </div>
            <div class="col-md-4 col-xs mb1r">
              <label for="commercialname">Nombre Comercial</label>
              <input type="text" name="commercialname" id="commercialname" class="form-control input-sm" placeholder="Nombre Comercial">
            </div>
            <div class="col-md-4 col-xs">
              <label for="rfc">RFC <span class="reqStar">*</span></label>
              <input type="text" name="rfc" id="rfc" class="form-control input-sm" placeholder="RFC" required>
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col-md-6">
              <label for="phone">Telefono <span class="reqStar">*</span></label>
              <input type="text" name="phone" id="phone" class="form-control input-sm" placeholder="Telefono" required>
            </div>
          </div>
          <div class="form-row text-center">
              <h4 class="text-center">Datos de dirección</h4>
          </div>
          <div class="form-row form-group">
              <div class="col">
                <label>Búsqueda por ciudad o estado</label>
                <input id="autocomplete_search" name="autocomplete_search" type="text" class="form-control" placeholder="Search" />
            </div>
          </div>
          <div class="form-row form-group">
                <div class="col">
                  <label for="city">Ciudad <span class="reqStar">*</span></label>
                  <input type="text" name="city" id="city" readonly class="form-control input-sm" placeholder="Ciudad" required>
                </div>
                <div class="col">
                  <label for="state">Estado <span class="reqStar">*</span></label>
                  <input type="text" name="state" id="state" readonly class="form-control input-sm" placeholder="Estado" required>
               </div>
              </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="number">Numero de casa <span class="reqStar">*</span></label>
              <input type="text" name="number" id="number" class="form-control input-sm" placeholder="Numero de casa/Departamento" required>
            </div>
            <div class="col">
                <label for="street">Calle <span class="reqStar">*</span></label>
                <input type="text" name="street" id="street" class="form-control input-sm" placeholder="Calle" required>
            </div>
          </div>
          <div class="form-row form-group">
            <div class="col">
              <label for="colony">Colonia <span class="reqStar">*</span></label>
              <input type="text" name="colony" id="colony" class="form-control input-sm" placeholder="Colonia" required>
            </div>
            <div class="col">
                <label for="postalCode">Código postal <span class="reqStar">*</span></label>
                <input type="number" name="postalCode" id="postalCode" class="form-control input-sm" placeholder="Codigo Postal" required>
            </div>
          </div>
          <div class="form-group form-row">
            <div class="col-md-6 col-xs mb1r">
              <a href="#" class="btn btn-info btn-block clientFormClose" >Cerrar</a>
            </div>
            <div class="col-md-6 col-xs">
              <input type="submit"  value="Guardar" class="btn btn-success btn-block createClient">
            </div>
          </div>
        </form>

<script>
  $(".newClientForm").validate({
    lang:'es'
  });
</script>




