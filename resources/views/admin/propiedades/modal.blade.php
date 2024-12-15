<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Complete los campos requeridos *</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="messageForm" method="POST" action="{{ route('propiedades.sendMessage') }}">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property['id'] }}">
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Mensaje *</label>
                        <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{ old('body') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar consulta</button>
                </form>
            </div>
        </div>
    </div>
</div>