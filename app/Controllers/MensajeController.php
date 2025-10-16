<?php

// app/Controllers/MensajeController.php

class MensajeController extends Controller {

  public function index() {

    $mensajes = Mensaje::all();

    $this->view('Mensajes/index', compact('mensajes'));

  }

  public function create() {

    $this->view('Mensajes/create');

  }

  private function handleUpload(?array $file): ?string {

    if (!$file || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;

    if (($file['error'] ?? 0) !== UPLOAD_ERR_OK) throw new RuntimeException('Error al subir la imagen.');

    if ($file['size'] > MAX_IMAGE_BYTES) throw new RuntimeException('La imagen excede 2MB.');

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    

    if (!in_array($ext, ALLOWED_EXT, true)) throw new RuntimeException('Extensión no permitida.');

    

    $basename = bin2hex(random_bytes(8)) . '.' . $ext;

    $dest = rtrim(UPLOAD_DIR, '/\\') . DIRECTORY_SEPARATOR . $basename;

    if (!move_uploaded_file($file['tmp_name'], $dest)) throw new RuntimeException('No se pudo guardar la imagen.');

    return (BASE_URL ? rtrim(BASE_URL,'/') : '') . '/img/' . $basename;

  }

  public function store() {

    try {

      $titulo = trim($_POST['titulo'] ?? '');

      $descripcion = trim($_POST['descripcion'] ?? '');

      $fecha = trim($_POST['fecha'] ?? '');

      if ($titulo === '' || $descripcion === '' || $fecha === '') throw new RuntimeException('Todos los campos son obligatorios.');

      $imagenPath = $this->handleUpload($_FILES['imagen'] ?? null);

      $id = Mensaje::create(['titulo'=>$titulo,'descripcion'=>$descripcion,'imagen'=>$imagenPath,'fecha'=>$fecha]);

      $this->redirect('/Mensajes/show?id=' . $id);

    } catch (Throwable $e) {

      $error = $e->getMessage();

      $this->view('Mensajes/create', compact('error'));

    }

  }

  public function show() {

    $id = (int)($_GET['id'] ?? 0);

    $mensaje = $id ? Mensaje::find($id) : null;

    if (!$mensaje) { http_response_code(404); echo 'Mensaje no encontrado'; return; }

    $this->view('Mensajes/show', compact('Mensajes'));

  }

  public function edit() {

    $id = (int)($_GET['id'] ?? 0);

    $mensaje = $id ? Mensaje::find($id) : null;

    if (!$mensaje) { http_response_code(404); echo 'Mensaje no encontrado'; return; }

    $this->view('Mensajes/edit', compact('Mensajes'));

  }

  public function update() {

    try {

      $id = (int)($_POST['id'] ?? 0);

      $orig = Mensaje::find($id);

      if (!$orig) throw new RuntimeException('Mensaje no existe.');

      $titulo = trim($_POST['titulo'] ?? '');

      $descripcion = trim($_POST['descripcion'] ?? '');

      $fecha = trim($_POST['fecha'] ?? '');

      if ($titulo === '' || $descripcion === '' || $fecha === '') throw new RuntimeException('Todos los campos son obligatorios.');

      $new = $this->handleUpload($_FILES['img'] ?? null);

      $imagenPath = ($new !== null) ? $new : ($orig['img'] ?? null);

      Mensaje::update($id, ['titulo'=>$titulo,'descripcion'=>$descripcion,'img'=>$imagenPath,'fecha'=>$fecha]);

      $this->redirect('/Mensajes/show?id=' . $id);

    } catch (Throwable $e) {

      $error = $e->getMessage();

      $mensaje = ['id'=>$_POST['id'] ?? 0, 'titulo'=>$_POST['titulo'] ?? '', 'descripcion'=>$_POST['descripcion'] ?? '', 'fecha'=>$_POST['fecha'] ?? '', 'img'=>$_POST['imagen_actual'] ?? null];

      $this->view('Mensajes/edit', compact('Mensajes','error'));

    }

  }

  public function destroy() {

    $id = (int)($_POST['id'] ?? 0);

    if ($id) Mensaje::delete($id);

    $this->redirect('/Mensajes');

  }

}

