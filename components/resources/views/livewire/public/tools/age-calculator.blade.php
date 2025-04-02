<div>

      <form wire:submit.prevent="onAgeCalculator">

        <div>
          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />
                                      
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3">
          <label class="form-label">{{ __('Select your Date of birth') }}</label>
          <div class="row g-2">
              <div class="col-12 col-md-4">
                <select wire:model.defer="byear" class="form-control form-select">
					          <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                    <option value="1997">1997</option>
                    <option value="1996">1996</option>
                    <option value="1995">1995</option>
                    <option value="1994">1994</option>
                    <option value="1993">1993</option>
                    <option value="1992">1992</option>
                    <option value="1991">1991</option>
                    <option value="1990">1990</option>
                    <option value="1989">1989</option>
                    <option value="1988">1988</option>
                    <option value="1987">1987</option>
                    <option value="1986">1986</option>
                    <option value="1985">1985</option>
                    <option value="1984">1984</option>
                    <option value="1983">1983</option>
                    <option value="1982">1982</option>
                    <option value="1981">1981</option>
                    <option value="1980">1980</option>
                    <option value="1979">1979</option>
                    <option value="1978">1978</option>
                    <option value="1977">1977</option>
                    <option value="1976">1976</option>
                    <option value="1975">1975</option>
                    <option value="1974">1974</option>
                    <option value="1973">1973</option>
                    <option value="1972">1972</option>
                    <option value="1971">1971</option>
                    <option value="1970">1970</option>
                    <option value="1969">1969</option>
                    <option value="1968">1968</option>
                    <option value="1967">1967</option>
                    <option value="1966">1966</option>
                    <option value="1965">1965</option>
                    <option value="1964">1964</option>
                    <option value="1963">1963</option>
                    <option value="1962">1962</option>
                    <option value="1961">1961</option>
                    <option value="1960">1960</option>
                    <option value="1959">1959</option>
                    <option value="1958">1958</option>
                    <option value="1957">1957</option>
                    <option value="1956">1956</option>
                    <option value="1955">1955</option>
                    <option value="1954">1954</option>
                    <option value="1953">1953</option>
                    <option value="1952">1952</option>
                    <option value="1951">1951</option>
                    <option value="1950">1950</option>
                    <option value="1949">1949</option>
                    <option value="1948">1948</option>
                    <option value="1947">1947</option>
                    <option value="1946">1946</option>
                    <option value="1945">1945</option>
                    <option value="1944">1944</option>
                    <option value="1943">1943</option>
                    <option value="1942">1942</option>
                    <option value="1941">1941</option>
                    <option value="1940">1940</option>
                    <option value="1939">1939</option>
                    <option value="1938">1938</option>
                    <option value="1937">1937</option>
                    <option value="1936">1936</option>
                    <option value="1935">1935</option>
                    <option value="1934">1934</option>
                    <option value="1933">1933</option>
                    <option value="1932">1932</option>
                    <option value="1931">1931</option>
                    <option value="1930">1930</option>
                    <option value="1929">1929</option>
                    <option value="1928">1928</option>
                    <option value="1927">1927</option>
                    <option value="1926">1926</option>
                    <option value="1925">1925</option>
                    <option value="1924">1924</option>
                    <option value="1923">1923</option>
                    <option value="1922">1922</option>
                    <option value="1921">1921</option>
                    <option value="1920">1920</option>
                    <option value="1919">1919</option>
                    <option value="1918">1918</option>
                    <option value="1917">1917</option>
                    <option value="1916">1916</option>
                    <option value="1915">1915</option>
                    <option value="1914">1914</option>
                    <option value="1913">1913</option>
                    <option value="1912">1912</option>
                    <option value="1911">1911</option>
                    <option value="1910">1910</option>
                    <option value="1909">1909</option>
                    <option value="1908">1908</option>
                    <option value="1907">1907</option>
                    <option value="1906">1906</option>
                    <option value="1905">1905</option>
                    <option value="1904">1904</option>
                    <option value="1903">1903</option>
                    <option value="1902">1902</option>
                    <option value="1901">1901</option>
                    <option value="1900">1900</option>
                    <option value="1899">1899</option>
                    <option value="1898">1898</option>
                    <option value="1897">1897</option>
                    <option value="1896">1896</option>
                    <option value="1895">1895</option>
                    <option value="1894">1894</option>
                    <option value="1893">1893</option>
                    <option value="1892">1892</option>
                    <option value="1891">1891</option>
                    <option value="1890">1890</option>
                    <option value="1889">1889</option>
                    <option value="1888">1888</option>
                    <option value="1887">1887</option>
                    <option value="1886">1886</option>
                    <option value="1885">1885</option>
                    <option value="1884">1884</option>
                    <option value="1883">1883</option>
                    <option value="1882">1882</option>
                    <option value="1881">1881</option>
                    <option value="1880">1880</option>
                    <option value="1879">1879</option>
                    <option value="1878">1878</option>
                    <option value="1877">1877</option>
                    <option value="1876">1876</option>
                    <option value="1875">1875</option>
                    <option value="1874">1874</option>
                    <option value="1873">1873</option>
                    <option value="1872">1872</option>
                    <option value="1871">1871</option>
                    <option value="1870">1870</option>
                    <option value="1869">1869</option>
                    <option value="1868">1868</option>
                    <option value="1867">1867</option>
                    <option value="1866">1866</option>
                    <option value="1865">1865</option>
                    <option value="1864">1864</option>
                    <option value="1863">1863</option>
                    <option value="1862">1862</option>
                    <option value="1861">1861</option>
                    <option value="1860">1860</option>
                    <option value="1859">1859</option>
                    <option value="1858">1858</option>
                    <option value="1857">1857</option>
                    <option value="1856">1856</option>
                    <option value="1855">1855</option>
                    <option value="1854">1854</option>
                    <option value="1853">1853</option>
                    <option value="1852">1852</option>
                    <option value="1851">1851</option>
                    <option value="1850">1850</option>
                    <option value="1849">1849</option>
                    <option value="1848">1848</option>
                    <option value="1847">1847</option>
                    <option value="1846">1846</option>
                    <option value="1845">1845</option>
                    <option value="1844">1844</option>
                    <option value="1843">1843</option>
                    <option value="1842">1842</option>
                    <option value="1841">1841</option>
                    <option value="1840">1840</option>
                    <option value="1839">1839</option>
                    <option value="1838">1838</option>
                    <option value="1837">1837</option>
                    <option value="1836">1836</option>
                    <option value="1835">1835</option>
                    <option value="1834">1834</option>
                    <option value="1833">1833</option>
                    <option value="1832">1832</option>
                    <option value="1831">1831</option>
                    <option value="1830">1830</option>
                    <option value="1829">1829</option>
                    <option value="1828">1828</option>
                    <option value="1827">1827</option>
                    <option value="1826">1826</option>
                    <option value="1825">1825</option>
                    <option value="1824">1824</option>
                    <option value="1823">1823</option>
                </select>
              </div>
              <div class="col-12 col-md-4">
                <select wire:model.defer="bmonth" class="form-control form-select">
                    <option value="1">{{ __('January') }}</option>
                    <option value="2">{{ __('February') }}</option>
                    <option value="3">{{ __('March') }}</option>
                    <option value="4">{{ __('April') }}</option>
                    <option value="5">{{ __('May') }}</option>
                    <option value="6">{{ __('June') }}</option>
                    <option value="7">{{ __('July') }}</option>
                    <option value="8">{{ __('August') }}</option>
                    <option value="9">{{ __('September') }}</option>
                    <option value="10">{{ __('October') }}</option>
                    <option value="11">{{ __('November') }}</option>
                    <option value="12">{{ __('December') }}</option>
                </select>
              </div>
              <div class="col-12 col-md-4">
                    <select wire:model.defer="bday" class="form-control form-select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
              </div>
          </div>
        </div>

        <div class="form-group mb-3">
          <label class="form-label">{{ __('Today\'s date') }}</label>
          <div class="row g-2">
              <div class="col-12 col-md-4">
                <select wire:model.defer="year" class="form-control form-select">
					          <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                    <option value="1997">1997</option>
                    <option value="1996">1996</option>
                    <option value="1995">1995</option>
                    <option value="1994">1994</option>
                    <option value="1993">1993</option>
                    <option value="1992">1992</option>
                    <option value="1991">1991</option>
                    <option value="1990">1990</option>
                    <option value="1989">1989</option>
                    <option value="1988">1988</option>
                    <option value="1987">1987</option>
                    <option value="1986">1986</option>
                    <option value="1985">1985</option>
                    <option value="1984">1984</option>
                    <option value="1983">1983</option>
                    <option value="1982">1982</option>
                    <option value="1981">1981</option>
                    <option value="1980">1980</option>
                    <option value="1979">1979</option>
                    <option value="1978">1978</option>
                    <option value="1977">1977</option>
                    <option value="1976">1976</option>
                    <option value="1975">1975</option>
                    <option value="1974">1974</option>
                    <option value="1973">1973</option>
                    <option value="1972">1972</option>
                    <option value="1971">1971</option>
                    <option value="1970">1970</option>
                    <option value="1969">1969</option>
                    <option value="1968">1968</option>
                    <option value="1967">1967</option>
                    <option value="1966">1966</option>
                    <option value="1965">1965</option>
                    <option value="1964">1964</option>
                    <option value="1963">1963</option>
                    <option value="1962">1962</option>
                    <option value="1961">1961</option>
                    <option value="1960">1960</option>
                    <option value="1959">1959</option>
                    <option value="1958">1958</option>
                    <option value="1957">1957</option>
                    <option value="1956">1956</option>
                    <option value="1955">1955</option>
                    <option value="1954">1954</option>
                    <option value="1953">1953</option>
                    <option value="1952">1952</option>
                    <option value="1951">1951</option>
                    <option value="1950">1950</option>
                    <option value="1949">1949</option>
                    <option value="1948">1948</option>
                    <option value="1947">1947</option>
                    <option value="1946">1946</option>
                    <option value="1945">1945</option>
                    <option value="1944">1944</option>
                    <option value="1943">1943</option>
                    <option value="1942">1942</option>
                    <option value="1941">1941</option>
                    <option value="1940">1940</option>
                    <option value="1939">1939</option>
                    <option value="1938">1938</option>
                    <option value="1937">1937</option>
                    <option value="1936">1936</option>
                    <option value="1935">1935</option>
                    <option value="1934">1934</option>
                    <option value="1933">1933</option>
                    <option value="1932">1932</option>
                    <option value="1931">1931</option>
                    <option value="1930">1930</option>
                    <option value="1929">1929</option>
                    <option value="1928">1928</option>
                    <option value="1927">1927</option>
                    <option value="1926">1926</option>
                    <option value="1925">1925</option>
                    <option value="1924">1924</option>
                    <option value="1923">1923</option>
                    <option value="1922">1922</option>
                    <option value="1921">1921</option>
                    <option value="1920">1920</option>
                    <option value="1919">1919</option>
                    <option value="1918">1918</option>
                    <option value="1917">1917</option>
                    <option value="1916">1916</option>
                    <option value="1915">1915</option>
                    <option value="1914">1914</option>
                    <option value="1913">1913</option>
                    <option value="1912">1912</option>
                    <option value="1911">1911</option>
                    <option value="1910">1910</option>
                    <option value="1909">1909</option>
                    <option value="1908">1908</option>
                    <option value="1907">1907</option>
                    <option value="1906">1906</option>
                    <option value="1905">1905</option>
                    <option value="1904">1904</option>
                    <option value="1903">1903</option>
                    <option value="1902">1902</option>
                    <option value="1901">1901</option>
                    <option value="1900">1900</option>
                    <option value="1899">1899</option>
                    <option value="1898">1898</option>
                    <option value="1897">1897</option>
                    <option value="1896">1896</option>
                    <option value="1895">1895</option>
                    <option value="1894">1894</option>
                    <option value="1893">1893</option>
                    <option value="1892">1892</option>
                    <option value="1891">1891</option>
                    <option value="1890">1890</option>
                    <option value="1889">1889</option>
                    <option value="1888">1888</option>
                    <option value="1887">1887</option>
                    <option value="1886">1886</option>
                    <option value="1885">1885</option>
                    <option value="1884">1884</option>
                    <option value="1883">1883</option>
                    <option value="1882">1882</option>
                    <option value="1881">1881</option>
                    <option value="1880">1880</option>
                    <option value="1879">1879</option>
                    <option value="1878">1878</option>
                    <option value="1877">1877</option>
                    <option value="1876">1876</option>
                    <option value="1875">1875</option>
                    <option value="1874">1874</option>
                    <option value="1873">1873</option>
                    <option value="1872">1872</option>
                    <option value="1871">1871</option>
                    <option value="1870">1870</option>
                    <option value="1869">1869</option>
                    <option value="1868">1868</option>
                    <option value="1867">1867</option>
                    <option value="1866">1866</option>
                    <option value="1865">1865</option>
                    <option value="1864">1864</option>
                    <option value="1863">1863</option>
                    <option value="1862">1862</option>
                    <option value="1861">1861</option>
                    <option value="1860">1860</option>
                    <option value="1859">1859</option>
                    <option value="1858">1858</option>
                    <option value="1857">1857</option>
                    <option value="1856">1856</option>
                    <option value="1855">1855</option>
                    <option value="1854">1854</option>
                    <option value="1853">1853</option>
                    <option value="1852">1852</option>
                    <option value="1851">1851</option>
                    <option value="1850">1850</option>
                    <option value="1849">1849</option>
                    <option value="1848">1848</option>
                    <option value="1847">1847</option>
                    <option value="1846">1846</option>
                    <option value="1845">1845</option>
                    <option value="1844">1844</option>
                    <option value="1843">1843</option>
                    <option value="1842">1842</option>
                    <option value="1841">1841</option>
                    <option value="1840">1840</option>
                    <option value="1839">1839</option>
                    <option value="1838">1838</option>
                    <option value="1837">1837</option>
                    <option value="1836">1836</option>
                    <option value="1835">1835</option>
                    <option value="1834">1834</option>
                    <option value="1833">1833</option>
                    <option value="1832">1832</option>
                    <option value="1831">1831</option>
                    <option value="1830">1830</option>
                    <option value="1829">1829</option>
                    <option value="1828">1828</option>
                    <option value="1827">1827</option>
                    <option value="1826">1826</option>
                    <option value="1825">1825</option>
                    <option value="1824">1824</option>
                    <option value="1823">1823</option>
                </select>
              </div>
              <div class="col-12 col-md-4">
                <select wire:model.defer="month" class="form-control form-select">
                    <option value="1">{{ __('January') }}</option>
                    <option value="2">{{ __('February') }}</option>
                    <option value="3">{{ __('March') }}</option>
                    <option value="4">{{ __('April') }}</option>
                    <option value="5">{{ __('May') }}</option>
                    <option value="6">{{ __('June') }}</option>
                    <option value="7">{{ __('July') }}</option>
                    <option value="8">{{ __('August') }}</option>
                    <option value="9">{{ __('September') }}</option>
                    <option value="10">{{ __('October') }}</option>
                    <option value="11">{{ __('November') }}</option>
                    <option value="12">{{ __('December') }}</option>
                </select>
              </div>
              <div class="col-12 col-md-4">
                    <select wire:model.defer="day" class="form-control form-select">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
              </div>
          </div>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group">
            <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onAgeCalculator">
                  <x-loading />
                </div>
                <span>{{ __('Calculate') }}</span>
              </span>
            </button>
        </div>

        @if ( !empty($data) )
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <td class="fw-bold">{{ __('Your Current Age:') }}</td>
                            <td>{{ $data['age'] }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">{{ __('Age in Months:') }}</td>
                            <td>{{ $data['months'] }} {{ __('month(s)') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">{{ __('Age in Weeks:') }}</td>
                            <td>{{ $data['weeks'] }} {{ __('week(s)') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">{{ __('Age in Days:') }}</td>
                            <td>{{ $data['days'] }} {{ __('day(s)') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif

      </form>
</div>