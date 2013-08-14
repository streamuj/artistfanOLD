<?php


/**
 * Base class that represents a query for the 'countries' table.
 *
 * 
 *
 * @method     CountriesQuery orderByIso2($order = Criteria::ASC) Order by the iso2 column
 * @method     CountriesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     CountriesQuery orderByPcode($order = Criteria::ASC) Order by the pcode column
 * @method     CountriesQuery orderBySortid($order = Criteria::ASC) Order by the sortid column
 * @method     CountriesQuery orderByIso3($order = Criteria::ASC) Order by the iso3 column
 *
 * @method     CountriesQuery groupByIso2() Group by the iso2 column
 * @method     CountriesQuery groupByName() Group by the name column
 * @method     CountriesQuery groupByPcode() Group by the pcode column
 * @method     CountriesQuery groupBySortid() Group by the sortid column
 * @method     CountriesQuery groupByIso3() Group by the iso3 column
 *
 * @method     CountriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CountriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CountriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     Countries findOne(PropelPDO $con = null) Return the first Countries matching the query
 * @method     Countries findOneOrCreate(PropelPDO $con = null) Return the first Countries matching the query, or a new Countries object populated from the query conditions when no match is found
 *
 * @method     Countries findOneByIso2(string $iso2) Return the first Countries filtered by the iso2 column
 * @method     Countries findOneByName(string $name) Return the first Countries filtered by the name column
 * @method     Countries findOneByPcode(string $pcode) Return the first Countries filtered by the pcode column
 * @method     Countries findOneBySortid(int $sortid) Return the first Countries filtered by the sortid column
 * @method     Countries findOneByIso3(int $iso3) Return the first Countries filtered by the iso3 column
 *
 * @method     array findByIso2(string $iso2) Return Countries objects filtered by the iso2 column
 * @method     array findByName(string $name) Return Countries objects filtered by the name column
 * @method     array findByPcode(string $pcode) Return Countries objects filtered by the pcode column
 * @method     array findBySortid(int $sortid) Return Countries objects filtered by the sortid column
 * @method     array findByIso3(int $iso3) Return Countries objects filtered by the iso3 column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseCountriesQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseCountriesQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'Countries', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CountriesQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CountriesQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CountriesQuery) {
			return $criteria;
		}
		$query = new CountriesQuery();
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
	 * @return    Countries|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = CountriesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(CountriesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Countries A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ISO2`, `NAME`, `PCODE`, `SORTID`, `ISO3` FROM `countries` WHERE `ISO2` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_STR);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Countries();
			$obj->hydrate($row);
			CountriesPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Countries|array|mixed the result, formatted by the current formatter
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
	 * @return    CountriesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CountriesPeer::ISO2, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CountriesQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CountriesPeer::ISO2, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the iso2 column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIso2('fooValue');   // WHERE iso2 = 'fooValue'
	 * $query->filterByIso2('%fooValue%'); // WHERE iso2 LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $iso2 The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CountriesQuery The current query, for fluid interface
	 */
	public function filterByIso2($iso2 = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($iso2)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $iso2)) {
				$iso2 = str_replace('*', '%', $iso2);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CountriesPeer::ISO2, $iso2, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CountriesQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CountriesPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the pcode column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPcode('fooValue');   // WHERE pcode = 'fooValue'
	 * $query->filterByPcode('%fooValue%'); // WHERE pcode LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $pcode The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CountriesQuery The current query, for fluid interface
	 */
	public function filterByPcode($pcode = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($pcode)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $pcode)) {
				$pcode = str_replace('*', '%', $pcode);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CountriesPeer::PCODE, $pcode, $comparison);
	}

	/**
	 * Filter the query on the sortid column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySortid(1234); // WHERE sortid = 1234
	 * $query->filterBySortid(array(12, 34)); // WHERE sortid IN (12, 34)
	 * $query->filterBySortid(array('min' => 12)); // WHERE sortid > 12
	 * </code>
	 *
	 * @param     mixed $sortid The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CountriesQuery The current query, for fluid interface
	 */
	public function filterBySortid($sortid = null, $comparison = null)
	{
		if (is_array($sortid)) {
			$useMinMax = false;
			if (isset($sortid['min'])) {
				$this->addUsingAlias(CountriesPeer::SORTID, $sortid['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($sortid['max'])) {
				$this->addUsingAlias(CountriesPeer::SORTID, $sortid['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CountriesPeer::SORTID, $sortid, $comparison);
	}

	/**
	 * Filter the query on the iso3 column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIso3(1234); // WHERE iso3 = 1234
	 * $query->filterByIso3(array(12, 34)); // WHERE iso3 IN (12, 34)
	 * $query->filterByIso3(array('min' => 12)); // WHERE iso3 > 12
	 * </code>
	 *
	 * @param     mixed $iso3 The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CountriesQuery The current query, for fluid interface
	 */
	public function filterByIso3($iso3 = null, $comparison = null)
	{
		if (is_array($iso3)) {
			$useMinMax = false;
			if (isset($iso3['min'])) {
				$this->addUsingAlias(CountriesPeer::ISO3, $iso3['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($iso3['max'])) {
				$this->addUsingAlias(CountriesPeer::ISO3, $iso3['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CountriesPeer::ISO3, $iso3, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Countries $countries Object to remove from the list of results
	 *
	 * @return    CountriesQuery The current query, for fluid interface
	 */
	public function prune($countries = null)
	{
		if ($countries) {
			$this->addUsingAlias(CountriesPeer::ISO2, $countries->getIso2(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseCountriesQuery