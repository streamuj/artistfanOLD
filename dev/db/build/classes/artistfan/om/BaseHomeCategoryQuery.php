<?php


/**
 * Base class that represents a query for the 'home_category' table.
 *
 * 
 *
 * @method     HomeCategoryQuery orderByHcId($order = Criteria::ASC) Order by the hc_id column
 * @method     HomeCategoryQuery orderByHcName($order = Criteria::ASC) Order by the hc_name column
 * @method     HomeCategoryQuery orderByHcType($order = Criteria::ASC) Order by the hc_type column
 * @method     HomeCategoryQuery orderByHcParent($order = Criteria::ASC) Order by the hc_parent column
 * @method     HomeCategoryQuery orderByHcOrder($order = Criteria::ASC) Order by the hc_order column
 * @method     HomeCategoryQuery orderByHcStatus($order = Criteria::ASC) Order by the hc_status column
 * @method     HomeCategoryQuery orderByHcText($order = Criteria::ASC) Order by the hc_text column
 *
 * @method     HomeCategoryQuery groupByHcId() Group by the hc_id column
 * @method     HomeCategoryQuery groupByHcName() Group by the hc_name column
 * @method     HomeCategoryQuery groupByHcType() Group by the hc_type column
 * @method     HomeCategoryQuery groupByHcParent() Group by the hc_parent column
 * @method     HomeCategoryQuery groupByHcOrder() Group by the hc_order column
 * @method     HomeCategoryQuery groupByHcStatus() Group by the hc_status column
 * @method     HomeCategoryQuery groupByHcText() Group by the hc_text column
 *
 * @method     HomeCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     HomeCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     HomeCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     HomeCategory findOne(PropelPDO $con = null) Return the first HomeCategory matching the query
 * @method     HomeCategory findOneOrCreate(PropelPDO $con = null) Return the first HomeCategory matching the query, or a new HomeCategory object populated from the query conditions when no match is found
 *
 * @method     HomeCategory findOneByHcId(int $hc_id) Return the first HomeCategory filtered by the hc_id column
 * @method     HomeCategory findOneByHcName(string $hc_name) Return the first HomeCategory filtered by the hc_name column
 * @method     HomeCategory findOneByHcType(int $hc_type) Return the first HomeCategory filtered by the hc_type column
 * @method     HomeCategory findOneByHcParent(int $hc_parent) Return the first HomeCategory filtered by the hc_parent column
 * @method     HomeCategory findOneByHcOrder(int $hc_order) Return the first HomeCategory filtered by the hc_order column
 * @method     HomeCategory findOneByHcStatus(int $hc_status) Return the first HomeCategory filtered by the hc_status column
 * @method     HomeCategory findOneByHcText(string $hc_text) Return the first HomeCategory filtered by the hc_text column
 *
 * @method     array findByHcId(int $hc_id) Return HomeCategory objects filtered by the hc_id column
 * @method     array findByHcName(string $hc_name) Return HomeCategory objects filtered by the hc_name column
 * @method     array findByHcType(int $hc_type) Return HomeCategory objects filtered by the hc_type column
 * @method     array findByHcParent(int $hc_parent) Return HomeCategory objects filtered by the hc_parent column
 * @method     array findByHcOrder(int $hc_order) Return HomeCategory objects filtered by the hc_order column
 * @method     array findByHcStatus(int $hc_status) Return HomeCategory objects filtered by the hc_status column
 * @method     array findByHcText(string $hc_text) Return HomeCategory objects filtered by the hc_text column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseHomeCategoryQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseHomeCategoryQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'HomeCategory', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new HomeCategoryQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    HomeCategoryQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof HomeCategoryQuery) {
			return $criteria;
		}
		$query = new HomeCategoryQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    HomeCategory|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = HomeCategoryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(HomeCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    HomeCategory A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `HC_ID`, `HC_NAME`, `HC_TYPE`, `HC_PARENT`, `HC_ORDER`, `HC_STATUS`, `HC_TEXT` FROM `home_category` WHERE `HC_ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new HomeCategory();
			$obj->hydrate($row);
			HomeCategoryPeer::addInstanceToPool($obj, (string) $row[0]);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    HomeCategory|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(HomeCategoryPeer::HC_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(HomeCategoryPeer::HC_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the hc_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHcId(1234); // WHERE hc_id = 1234
	 * $query->filterByHcId(array(12, 34)); // WHERE hc_id IN (12, 34)
	 * $query->filterByHcId(array('min' => 12)); // WHERE hc_id > 12
	 * </code>
	 *
	 * @param     mixed $hcId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByHcId($hcId = null, $comparison = null)
	{
		if (is_array($hcId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(HomeCategoryPeer::HC_ID, $hcId, $comparison);
	}

	/**
	 * Filter the query on the hc_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHcName('fooValue');   // WHERE hc_name = 'fooValue'
	 * $query->filterByHcName('%fooValue%'); // WHERE hc_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $hcName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByHcName($hcName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($hcName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $hcName)) {
				$hcName = str_replace('*', '%', $hcName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(HomeCategoryPeer::HC_NAME, $hcName, $comparison);
	}

	/**
	 * Filter the query on the hc_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHcType(1234); // WHERE hc_type = 1234
	 * $query->filterByHcType(array(12, 34)); // WHERE hc_type IN (12, 34)
	 * $query->filterByHcType(array('min' => 12)); // WHERE hc_type > 12
	 * </code>
	 *
	 * @param     mixed $hcType The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByHcType($hcType = null, $comparison = null)
	{
		if (is_array($hcType)) {
			$useMinMax = false;
			if (isset($hcType['min'])) {
				$this->addUsingAlias(HomeCategoryPeer::HC_TYPE, $hcType['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($hcType['max'])) {
				$this->addUsingAlias(HomeCategoryPeer::HC_TYPE, $hcType['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeCategoryPeer::HC_TYPE, $hcType, $comparison);
	}

	/**
	 * Filter the query on the hc_parent column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHcParent(1234); // WHERE hc_parent = 1234
	 * $query->filterByHcParent(array(12, 34)); // WHERE hc_parent IN (12, 34)
	 * $query->filterByHcParent(array('min' => 12)); // WHERE hc_parent > 12
	 * </code>
	 *
	 * @param     mixed $hcParent The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByHcParent($hcParent = null, $comparison = null)
	{
		if (is_array($hcParent)) {
			$useMinMax = false;
			if (isset($hcParent['min'])) {
				$this->addUsingAlias(HomeCategoryPeer::HC_PARENT, $hcParent['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($hcParent['max'])) {
				$this->addUsingAlias(HomeCategoryPeer::HC_PARENT, $hcParent['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeCategoryPeer::HC_PARENT, $hcParent, $comparison);
	}

	/**
	 * Filter the query on the hc_order column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHcOrder(1234); // WHERE hc_order = 1234
	 * $query->filterByHcOrder(array(12, 34)); // WHERE hc_order IN (12, 34)
	 * $query->filterByHcOrder(array('min' => 12)); // WHERE hc_order > 12
	 * </code>
	 *
	 * @param     mixed $hcOrder The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByHcOrder($hcOrder = null, $comparison = null)
	{
		if (is_array($hcOrder)) {
			$useMinMax = false;
			if (isset($hcOrder['min'])) {
				$this->addUsingAlias(HomeCategoryPeer::HC_ORDER, $hcOrder['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($hcOrder['max'])) {
				$this->addUsingAlias(HomeCategoryPeer::HC_ORDER, $hcOrder['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeCategoryPeer::HC_ORDER, $hcOrder, $comparison);
	}

	/**
	 * Filter the query on the hc_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHcStatus(1234); // WHERE hc_status = 1234
	 * $query->filterByHcStatus(array(12, 34)); // WHERE hc_status IN (12, 34)
	 * $query->filterByHcStatus(array('min' => 12)); // WHERE hc_status > 12
	 * </code>
	 *
	 * @param     mixed $hcStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByHcStatus($hcStatus = null, $comparison = null)
	{
		if (is_array($hcStatus)) {
			$useMinMax = false;
			if (isset($hcStatus['min'])) {
				$this->addUsingAlias(HomeCategoryPeer::HC_STATUS, $hcStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($hcStatus['max'])) {
				$this->addUsingAlias(HomeCategoryPeer::HC_STATUS, $hcStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(HomeCategoryPeer::HC_STATUS, $hcStatus, $comparison);
	}

	/**
	 * Filter the query on the hc_text column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHcText('fooValue');   // WHERE hc_text = 'fooValue'
	 * $query->filterByHcText('%fooValue%'); // WHERE hc_text LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $hcText The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function filterByHcText($hcText = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($hcText)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $hcText)) {
				$hcText = str_replace('*', '%', $hcText);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(HomeCategoryPeer::HC_TEXT, $hcText, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     HomeCategory $homeCategory Object to remove from the list of results
	 *
	 * @return    HomeCategoryQuery The current query, for fluid interface
	 */
	public function prune($homeCategory = null)
	{
		if ($homeCategory) {
			$this->addUsingAlias(HomeCategoryPeer::HC_ID, $homeCategory->getHcId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseHomeCategoryQuery