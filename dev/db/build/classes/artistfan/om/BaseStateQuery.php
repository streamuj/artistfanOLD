<?php


/**
 * Base class that represents a query for the 'state' table.
 *
 * 
 *
 * @method     StateQuery orderByStateCode($order = Criteria::ASC) Order by the state_code column
 * @method     StateQuery orderByStateName($order = Criteria::ASC) Order by the state_name column
 *
 * @method     StateQuery groupByStateCode() Group by the state_code column
 * @method     StateQuery groupByStateName() Group by the state_name column
 *
 * @method     StateQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     StateQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     StateQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     State findOne(PropelPDO $con = null) Return the first State matching the query
 * @method     State findOneOrCreate(PropelPDO $con = null) Return the first State matching the query, or a new State object populated from the query conditions when no match is found
 *
 * @method     State findOneByStateCode(string $state_code) Return the first State filtered by the state_code column
 * @method     State findOneByStateName(string $state_name) Return the first State filtered by the state_name column
 *
 * @method     array findByStateCode(string $state_code) Return State objects filtered by the state_code column
 * @method     array findByStateName(string $state_name) Return State objects filtered by the state_name column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseStateQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseStateQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'State', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new StateQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    StateQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof StateQuery) {
			return $criteria;
		}
		$query = new StateQuery();
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
	 * @return    State|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = StatePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(StatePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    State A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `STATE_CODE`, `STATE_NAME` FROM `state` WHERE `STATE_CODE` = :p0';
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
			$obj = new State();
			$obj->hydrate($row);
			StatePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    State|array|mixed the result, formatted by the current formatter
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
	 * @return    StateQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(StatePeer::STATE_CODE, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    StateQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(StatePeer::STATE_CODE, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the state_code column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStateCode('fooValue');   // WHERE state_code = 'fooValue'
	 * $query->filterByStateCode('%fooValue%'); // WHERE state_code LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $stateCode The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StateQuery The current query, for fluid interface
	 */
	public function filterByStateCode($stateCode = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($stateCode)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $stateCode)) {
				$stateCode = str_replace('*', '%', $stateCode);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(StatePeer::STATE_CODE, $stateCode, $comparison);
	}

	/**
	 * Filter the query on the state_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStateName('fooValue');   // WHERE state_name = 'fooValue'
	 * $query->filterByStateName('%fooValue%'); // WHERE state_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $stateName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    StateQuery The current query, for fluid interface
	 */
	public function filterByStateName($stateName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($stateName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $stateName)) {
				$stateName = str_replace('*', '%', $stateName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(StatePeer::STATE_NAME, $stateName, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     State $state Object to remove from the list of results
	 *
	 * @return    StateQuery The current query, for fluid interface
	 */
	public function prune($state = null)
	{
		if ($state) {
			$this->addUsingAlias(StatePeer::STATE_CODE, $state->getStateCode(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseStateQuery