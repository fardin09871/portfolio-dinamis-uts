
@extends('admin.layouts.app')

@section('title', 'Manage Tech Stack')

@section('content')

<div class="tech-manager">

    <div class="manager-header">
        <div>
            <span>04 / SKILLS</span>
            <h1>SKILLS<span>.</span></h1>
            <p>Manage the technologies shown in the Skills section.</p>
        </div>

        <small>{{ $techStacks->count() }} TECHNOLOGIES</small>
    </div>

    @if(session('success'))
        <div class="success-alert">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-alert">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section class="tech-panel">

        <h2>SKILLS COLLECTION</h2>

        @foreach($techStacks as $stack)

            <form action="{{ route('admin.tech-stacks.update', $stack->id) }}"
                  method="POST"
                  class="tech-row">

                @csrf
                @method('PUT')

                <div class="field">
                    <label>TECHNOLOGY NAME</label>
                    <input type="text"
                           name="name"
                           value="{{ $stack->name }}"
                           required>
                </div>

                <div class="field">
                    <label>CATEGORY</label>
                    <input type="text"
                           name="category"
                           value="{{ $stack->category }}">
                </div>

                <div class="field">
                    <label>LOGO URL</label>
                    <input type="text"
                           name="icon"
                           value="{{ $stack->icon }}"
                           placeholder="https://cdn.simpleicons.org/nextdotjs/ffffff">
                </div>

                <div class="field order-field">
                    <label>ORDER</label>
                    <input type="number"
                           name="sort_order"
                           min="0"
                           value="{{ $stack->sort_order }}">
                </div>

                <button type="submit" class="save-btn">
                    SAVE
                </button>

                <button type="button"
                        class="delete-btn"
                        onclick="confirmDelete(this)">
                    DELETE
                </button>

            </form>

        @endforeach

    </section>

    <section class="tech-panel add-panel">

        <h2>+ ADD NEW TECHNOLOGY</h2>

        <form action="{{ route('admin.tech-stacks.store') }}"
              method="POST">

            @csrf

            <div class="add-grid">

                <div class="field">
                    <label>TECHNOLOGY NAME</label>
                    <input type="text"
                           name="name"
                           placeholder="Next.js"
                           required>
                </div>

                <div class="field">
                    <label>CATEGORY</label>
                    <input type="text"
                           name="category"
                           placeholder="Frontend">
                </div>

                <div class="field">
                    <label>LOGO URL</label>
                    <input type="text"
                           name="icon"
                           placeholder="https://cdn.simpleicons.org/nextdotjs/ffffff">
                </div>

                <div class="field">
                    <label>ORDER</label>
                    <input type="number"
                           name="sort_order"
                           min="0"
                           value="0">
                </div>

            </div>

            <button type="submit" class="save-btn">
                ADD TECHNOLOGY →
            </button>

        </form>

    </section>

</div>

@endsection

@push('styles')
<style>
.tech-manager {
    max-width: 1100px;
    margin: auto;
}

.manager-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    gap: 20px;
}

.manager-header span {
    color: #e62429;
    font-size: 10px;
    font-weight: 900;
    letter-spacing: 2px;
}

.manager-header h1 {
    margin-top: 10px;
    font-family: 'Anton', sans-serif;
    font-size: 36px;
}

.manager-header h1 span {
    color: #e62429;
}

.manager-header p,
.manager-header small {
    color: #92929c;
    font-size: 11px;
}

.tech-panel {
    padding: 25px;
    margin-bottom: 25px;
    background: #0d1019;
    border: 1px solid rgba(255,255,255,.09);
}

.tech-panel h2 {
    margin-bottom: 22px;
    color: #e62429;
    font-size: 11px;
    letter-spacing: 1.5px;
}

.tech-row {
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr 80px auto auto;
    gap: 12px;
    align-items: end;
    padding: 17px 0;
    border-bottom: 1px solid rgba(255,255,255,.08);
}

.field label {
    display: block;
    margin-bottom: 8px;
    color: #92929c;
    font-size: 9px;
    font-weight: 900;
}

.field input {
    width: 100%;
    min-width: 0;
    padding: 12px;
    background: #080a10;
    border: 1px solid rgba(255,255,255,.12);
    color: white;
    outline: none;
    font-size: 11px;
}

.field input:focus {
    border-color: #e62429;
}

.save-btn,
.delete-btn {
    padding: 12px 15px;
    border: 1px solid #e62429;
    background: #e62429;
    color: white;
    font-size: 9px;
    font-weight: 900;
    cursor: pointer;
}

.delete-btn {
    background: transparent;
    color: #ff7378;
}

.save-btn:hover {
    background: transparent;
    color: #ff555b;
}

.delete-btn:hover {
    background: #e62429;
    color: white;
}

.add-panel {
    border-style: dashed;
    border-color: rgba(230,36,41,.4);
}

.add-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 20px;
}

.empty-state {
    color: #92929c;
    font-size: 12px;
}

.success-alert,
.error-alert {
    padding: 15px;
    margin-bottom: 20px;
    font-size: 11px;
}

.success-alert {
    color: #7ee5a0;
    background: rgba(50,200,100,.08);
}

.error-alert {
    color: #ff7378;
    background: rgba(230,36,41,.1);
}

@media(max-width: 850px) {
    .tech-row {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .tech-row button {
        width: 100%;
    }
}

@media(max-width: 500px) {
    .add-grid {
        grid-template-columns: 1fr;
    }

    .manager-header {
        align-items: flex-start;
        flex-direction: column;
    }
}
</style>
@endpush

@push('scripts')
<script>
function confirmDelete(button) {
    if (!confirm('Delete this technology?')) {
        return;
    }

    const form = button.closest('form');

    const method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';

    form.appendChild(method);
    form.submit();
}
</script>
@endpush
