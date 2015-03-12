<?hh // strict
/**
 * FlickrRepository.php file.
 * Created at 11.03.2015
 *
 * @author Meelis-Marius Pinka <meelis@c0de.ee>
 * @copyright Copyright &copy; 2015 Code OÜ
 */

namespace App\Services;

use App\Models\FlickrImage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class FlickrRepository implements IFlickrRepository
{
    /**
     * Interface stub
     *
     * @return bool
     */
    public function isCached(): bool
    {
        return false;
    }

    /**
     * Retrieves image Collection from repository
     *
     * @param string $tags
     * @return Collection
     * @throws \Exception
     */
    public function getImagesByTags(string $tags): Collection
    {
        $images = new Collection();
        $imagesData = $this->loadData($tags);

        foreach ($imagesData as $imageData) {
            $imageData = (array)$imageData;

            if (!isset($imageData['link'])) {
                continue;
            }

            $image = new FlickrImage();

            foreach ($imageData['link'] as $linkData) {
                $linkData = (array)$linkData;

                if ($linkData["@attributes"]["rel"] == 'alternate') {
                    $image->shareLink = $linkData["@attributes"]["href"];
                } else {
                    $image->imageUrl = $linkData["@attributes"]["href"];
                }
            }

            $image->title = $imageData["title"];

            $images->push($image);
        }

        return $images;
    }

    /**
     * Fetches XML from Flickr api
     *
     * @param string $tags
     * @return SimpleXMLElement
     * @throws \Exception
     */
    private function loadData(string $tags): array
    {
        $url = str_replace('{TAGS}', $tags, Config::get('app.flickr_url'));

        try {
            /** @var $xmlData \SimpleXMLElement */
            $xmlData = (array)simplexml_load_string(file_get_contents($url));
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch image list from Flickr');
        }

        if(!isset($xmlData['entry'])) {
            throw new \Exception('No data from Flickr');
        }

        //only one element returned
        if (isset($xmlData['entry']->title)) {
            return array($xmlData['entry']);
        }

        return $xmlData['entry'];
    }
}