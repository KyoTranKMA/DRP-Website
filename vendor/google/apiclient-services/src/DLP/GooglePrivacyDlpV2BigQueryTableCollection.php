<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\DLP;

class GooglePrivacyDlpV2BigQueryTableCollection extends \Google\Model
{
  /**
   * @var GooglePrivacyDlpV2BigQueryRegexes
   */
  public $includeRegexes;
  protected $includeRegexesType = GooglePrivacyDlpV2BigQueryRegexes::class;
  protected $includeRegexesDataType = '';

  /**
   * @param GooglePrivacyDlpV2BigQueryRegexes
   */
  public function setIncludeRegexes(GooglePrivacyDlpV2BigQueryRegexes $includeRegexes)
  {
    $this->includeRegexes = $includeRegexes;
  }
  /**
   * @return GooglePrivacyDlpV2BigQueryRegexes
   */
  public function getIncludeRegexes()
  {
    return $this->includeRegexes;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GooglePrivacyDlpV2BigQueryTableCollection::class, 'Google_Service_DLP_GooglePrivacyDlpV2BigQueryTableCollection');
