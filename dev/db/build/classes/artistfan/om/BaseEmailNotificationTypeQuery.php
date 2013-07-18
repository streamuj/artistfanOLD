<?php


/**
 * Base class that represents a query for the 'emil_notification_type' table.
 *
 * 
 *
 * @method     EmailNotificationTypeQuery orderByEntId($order = Criteria::ASC) Order by the ent_id column
 * @method     EmailNotificationTypeQuery orderByEntName($order = Criteria::ASC) Order by the ent_name column
 * @method     EmailNotificationTypeQuery orderByEntStatus($order = Criteria::ASC) Order by the ent_status column
 *
 * @method     EmailNotificationTypeQuery groupByEntId() Group by the ent_id column
 * @method     EmailNotificationTypeQuery groupByEntName() Group by the ent_name column
 * @method     EmailNotificationTypeQuery groupByEntStatus() Group by the ent_status column
 *
 * @method     EmailNotificationTypeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EmailNotificationTypeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EmailNotificationTypeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     EmailNotificationType findOne(PropelPDO $con = null) Return the first EmailNotificationType matching the query
 * @method     EmailNotificationType findOneOrCreate(PropelPDO $con = null) Return the first EmailNotificationType matching the query, or a new EmailNotificationType object populated from the query conditions when no match is found
 *
 * @method     EmailNotificationType findOneByEntId(int $ent_id) Return the first EmailNotificationType filtered by the ent_id column
 * @method     EmailNotificationType findOneByEntName(string $ent_name) Return the first EmailNotificationType filtered by the ent_name column
 * @method     EmailNotificationType findOneByEntStatus(int $ent_status) Return the first EmailNotificationType filtered by the ent_status column
 *
 * @method     array findByEntId(int $ent_id) Return EmailNotificationType objects filtered by the ent_id column
 * @method     array findByEntName(string $ent_name) Return EmailNotificationType objects filtered by the ent_name column
 * @method     array findByEntStatus(int $ent_status) Return EmailNotificationType objects filtered by the ent_status column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseEmailNotificationTypeQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseEmailNotificationTypeQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'EmailNotificationType', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EmailNotificationTypeQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EmailNotificationTypeQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EmailNotificationTypeQuery) {
			return $criteria;
		}
		$query = new EmailNotificationTypeQuery();
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
	 * @return    EmailNotificationType|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = EmailNotificationTypePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(EmailNotificationTypePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    EmailNotificationType A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ENT_ID`, `ENT_NAME`, `ENT_STATUS` FROM `emil_notification_type` WHERE `ENT_ID` = :p0';
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
			$obj = new EmailNotificationType();
			$obj->hydrate($row);
			EmailNotificationTypePeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    EmailNotificationType|array|mixed the result, formatted by the current formatter
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
	 * @return    EmailNotificationTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(EmailNotificationTypePeer::ENT_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EmailNotificationTypeQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(EmailNotificationTypePeer::ENT_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the ent_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEntId(1234); // WHERE ent_id = 1234
	 * $query->filterByEntId(array(12, 34)); // WHERE ent_id IN (12, 34)
	 * $query->filterByEntId(array('min' => 12)); // WHERE ent_id > 12
	 * </code>
	 *
	 * @param     mixed $entId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailNotificationTypeQuery The current query, for fluid interface
	 */
	public function filterByEntId($entId = null, $comparison = null)
	{
		if (is_array($entId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EmailNotificationTypePeer::ENT_ID, $entId, $comparison);
	}

	/**
	 * Filter the query on the ent_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEntName('fooValue');   // WHERE ent_name = 'fooValue'
	 * $query->filterByEntName('%fooValue%'); // WHERE ent_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $entName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailNotificationTypeQuery The current query, for fluid interface
	 */
	public function filterByEntName($entName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($entName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $entName)) {
				$entName = str_replace('*', '%', $entName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(EmailNotificationTypePeer::ENT_NAME, $entName, $comparison);
	}

	/**
	 * Filter the query on the ent_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEntStatus(1234); // WHERE ent_status = 1234
	 * $query->filterByEntStatus(array(12, 34)); // WHERE ent_status IN (12, 34)
	 * $query->filterByEntStatus(array('min' => 12)); // WHERE ent_status > 12
	 * </code>
	 *
	 * @param     mixed $entStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailNotificationTypeQuery The current query, for fluid interface
	 */
	public function filterByEntStatus($entStatus = null, $comparison = null)
	{
		if (is_array($entStatus)) {
			$useMinMax = false;
			if (isset($entStatus['min'])) {
				$this->addUsingAlias(EmailNotificationTypePeer::ENT_STATUS, $entStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($entStatus['max'])) {
				$this->addUsingAlias(EmailNotificationTypePeer::ENT_STATUS, $entStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EmailNotificationTypePeer::ENT_STATUS, $entStatus, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     EmailNotificationType $emailNotificationType Object to remove from the list of results
	 *
	 * @return    EmailNotificationTypeQuery The current query, for fluid interface
	 */
	public function prune($emailNotificationType = null)
	{
		if ($emailNotificationType) {
			$this->addUsingAlias(EmailNotificationTypePeer::ENT_ID, $emailNotificationType->getEntId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseEmailNotificationTypeQuery