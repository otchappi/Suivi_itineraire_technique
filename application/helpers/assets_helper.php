<?php

if (!function_exists('assets')) {
    function assets($url)
    {
        return base_url("assets" . '/' . $url);
    }
}


if (!function_exists('css')) {
    function css($url)
    {
        return strpos($url, '.css?v')  ? assets("$url") : assets("$url.css");
    }
}

if (!function_exists('js')) {
    function js($url)
    {
        return strpos($url, '.js?v')  ? assets("$url") : assets("$url.js");
    }
}

if (!function_exists('img')) {
    function img($url)
    {
        return assets("$url");
    }
}

if (!function_exists('scss')) {
    function scss($url)
    {
        return strpos($url, '.scss?v') ? assets("scss/$url") : assets("scss/$url.scss");
    }
}

if (!function_exists('font')) {
    function font($url)
    {
        return assets("font/$url");
    }
}

if (!function_exists('vendor_css')) {
    function vendor_css($url)
    {
        return strpos($url, '.css?v') ? assets("vendor/$url") : assets("vendor/$url.css");
    }
}

if (!function_exists('vendor_js')) {
    function vendor_js($url)
    {
        return strpos($url, '.js?v')  ? assets("vendor/$url") : assets("vendor/$url.js");
    }
}

if ( ! function_exists('breadcrumb')) {
	function breadcrumb($data)
	{
		?>
		<ul class="breadcrumb">

			<?php

			$i = 0;
			foreach ($data as $label => $url) {
				if ($i < count($data) - 1) {
					?>
					<li class="breadcrumb-item"><a href="<?php echo $url ?>"><?php echo $label ?></a></li>
					<?php
				} else {
					?>
					<li class="breadcrumb-item active"><?php echo $label ?></li>
					<?php
				}
				$i++;
			}
			?>
		</ul>
		<?php
	}
}

if ( ! function_exists('theme_css')) {
	function theme_css($nom) {
		return assets('theme/css/' . $nom .'.css');
	}
}


