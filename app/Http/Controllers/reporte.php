<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h2 align="center">Reporte recibido</h2>
<pre>
	Archivo: <?php echo $archivo->name ?>
</pre>
<hr>
<h4>Vistos por:</h4>
<table>
    <thead>
      <tr style="background-color:#DCDCDC;">
        <th>Foto</th>
        <th>Nombre Apellido</th>
        <th>Fecha</th>
        <th>Hora</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach ($posts_vistos as $post): ?>
		<tr>
			<td>
			<?php $url = asset('storage/'.$post->councilor->avatar); ?>
				<img width="70" src="<?php echo $url ?>" alt=""/>
			</td>
			<td>
				<?php echo $post->councilor->name ?>
			</td>
			<td>
			<?php 
				$update = new Date($post->update_at);
              	echo $update->format('j-m-Y');
			?>	
			</td>
			<td>
				<?php echo $update->format('H:i:s'); ?>
			</td>
      	</tr>
		<?php endforeach ?>
    </tbody>
  </table>

<h4>Aún por ver:</h4>
<table>
    <thead>
      <tr style="background-color:#DCDCDC;">
        <th>Foto</th>
        <th>Nombre Apellido</th>
        <th>Fecha</th>
        <th>Hora</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach ($posts_no_vistos as $post): ?>
		<tr>
			<td>
			<?php $url = asset('storage/'.$post->councilor->avatar); ?>
				<img width="70" src="<?php echo $url ?>" alt=""/>
			</td>
			<td>
				<?php echo $post->councilor->name ?>
			</td>
			<td>
			<?php 
				$update = new Date($post->update_at);
              	echo $update->format('j-m-Y');
			?>	
			</td>
			<td>
				<?php echo $update->format('H:i:s'); ?>
			</td>
      	</tr>
		<?php endforeach ?>
    </tbody>
  </table>
</body>
</html>