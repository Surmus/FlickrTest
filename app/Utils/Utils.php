<?hh // strict
/**
 * Utils.php file.
 * Created at 11.03.2015
 *
 * @author Meelis-Marius Pinka <meelis@c0de.ee>
 * @copyright Copyright &copy; 2015 Code OÜ
 */

namespace App\Utils;

use App\Services\FlickrRepository;
use App\Services\FlickrCacheableRepository;
use Illuminate\Support\Facades\Config;
use App\Services\IFlickrRepository;

class Utils
{
    /**
     * returns IFlickrRepository object determined by config setting
     *
     * @return FlickrCacheableRepository|FlickrRepository
     */
    public static function getFlickrRepository(): IFlickrRepository
    {
        if (Config::get('app.image_cache_enabled')) {
            return new FlickrCacheableRepository();
        }

        return new FlickrRepository();
    }
}