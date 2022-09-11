<?php
/**
 * @copyright Copyright © 2022, Zoran Dori.
 * @license GPL-2.0-or-later
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2
 * of the License.
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 * See the GNU General Public License for more details.
 */

/**
 * This extension realizes a new MagicWord __NUMBEREDHEADINGS__.
 * If an article contains this MagicWord, numbering of the
 * headings is performed regardless of the user preference setting.
 *
 * How to use:
 * * include this extension in LocalSettings.php:
 *	 require_once($IP.'/extensions/MagicNoNumberedHeadings.php');
 * * Add "__NUMBEREDHEADINGS__" to any article of your choice.
 *
 * @author Zoran Dori
 * @version 1.1
 */

class MagicNumberedHeadings {

	/**
	 * @param array &$ids
	 * @return bool
	 */
	public static function onGetDoubleUnderscoreIDs( array &$ids ) {
		$ids[] = 'MAG_NUMBEREDHEADINGS';
		return true;
	}

	/**
	 * @param Parser $parser
	 * @param string &$text
	 * @param StripState $stripState
	 * @return bool
	 */
	public static function onParserAfterParse(
		Parser $parser, string &$text, StripState $stripState
	) {
		if ( $parser->getOutput()->getPageProperty( 'MAG_MAGICNUMBEREDHEADINGS' ) !== null ) {
			$parser->getOutput()->addModuleStyles( [ 'ext.NumberedHeadings.styles' ] );
			$parser->getOutput()->addModules( [ 'ext.NumberedHeadings' ] );
		}
		return true;
	}
}
