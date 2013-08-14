<?php


/**
 * Base class that represents a query for the 'emil_notification_setting' table.
 *
 * 
 *
 * @method     EmailNotificationSettingQuery orderByEnsId($order = Criteria::ASC) Order by the ens_id column
 * @method     EmailNotificationSettingQuery orderByEnsUserId($order = Criteria::ASC) Order by the ens_user_id column
 * @method     EmailNotificationSettingQuery orderByEnsEntId($order = Criteria::ASC) Order by the ens_ent_id column
 * @method     EmailNotificationSettingQuery orderByEnsStatus($order = Criteria::ASC) Order by the ens_status column
 *
 * @method     EmailNotificationSettingQuery groupByEnsId() Group by the ens_id column
 * @method     EmailNotificationSettingQuery groupByEnsUserId() Group by the ens_user_id column
 * @method     EmailNotificationSettingQuery groupByEnsEntId() Group by the ens_ent_id column
 * @method     EmailNotificationSettingQuery groupByEnsStatus() Group by the ens_status column
 *
 * @method     EmailNotificationSettingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     EmailNotificationSettingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     EmailNotificationSettingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     EmailNotificationSetting findOne(PropelPDO $con = null) Return the first EmailNotificationSetting matching the query
 * @method     EmailNotificationSetting findOneOrCreate(PropelPDO $con = null) Return the first EmailNotificationSetting matching the query, or a new EmailNotificationSetting object populated from the query conditions when no match is found
 *
 * @method     EmailNotificationSetting findOneByEnsId(int $ens_id) Return the first EmailNotificationSetting filtered by the ens_id column
 * @method     EmailNotificationSetting findOneByEnsUserId(int $ens_user_id) Return the first EmailNotificationSetting filtered by the ens_user_id column
 * @method     EmailNotificationSetting findOneByEnsEntId(int $ens_ent_id) Return the first EmailNotificationSetting filtered by the ens_ent_id column
 * @method     EmailNotificationSetting findOneByEnsStatus(int $ens_status) Return the first EmailNotificationSetting filtered by the ens_status column
 *
 * @method     array findByEnsId(int $ens_id) Return EmailNotificationSetting objects filtered by the ens_id column
 * @method     array findByEnsUserId(int $ens_user_id) Return EmailNotificationSetting objects filtered by the ens_user_id column
 * @method     array findByEnsEntId(int $ens_ent_id) Return EmailNotificationSetting objects filtered by the ens_ent_id column
 * @method     array findByEnsStatus(int $ens_status) Return EmailNotificationSetting objects filtered by the ens_status column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseEmailNotificationSettingQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseEmailNotificationSettingQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'artistfan', $modelName = 'EmailNotificationSetting', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new EmailNotificationSettingQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    EmailNotificationSettingQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof EmailNotificationSettingQuery) {
			return $criteria;
		}
		$query = new EmailNotificationSettingQuery();
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
	 * @return    EmailNotificationSetting|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = EmailNotificationSettingPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(EmailNotificationSettingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    EmailNotificationSetting A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ENS_ID`, `ENS_USER_ID`, `ENS_ENT_ID`, `ENS_STATUS` FROM `emil_notification_setting` WHERE `ENS_ID` = :p0';
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
			$obj = new EmailNotificationSetting();
			$obj->hydrate($row);
			EmailNotificationSettingPeer::addInstanceToPool($obj, (string) $row[0]);
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
	 * @return    EmailNotificationSetting|array|mixed the result, formatted by the current formatter
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
	 * @return    EmailNotificationSettingQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(EmailNotificationSettingPeer::ENS_ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    EmailNotificationSettingQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(EmailNotificationSettingPeer::ENS_ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the ens_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEnsId(1234); // WHERE ens_id = 1234
	 * $query->filterByEnsId(array(12, 34)); // WHERE ens_id IN (12, 34)
	 * $query->filterByEnsId(array('min' => 12)); // WHERE ens_id > 12
	 * </code>
	 *
	 * @param     mixed $ensId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailNotificationSettingQuery The current query, for fluid interface
	 */
	public function filterByEnsId($ensId = null, $comparison = null)
	{
		if (is_array($ensId) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(EmailNotificationSettingPeer::ENS_ID, $ensId, $comparison);
	}

	/**
	 * Filter the query on the ens_user_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEnsUserId(1234); // WHERE ens_user_id = 1234
	 * $query->filterByEnsUserId(array(12, 34)); // WHERE ens_user_id IN (12, 34)
	 * $query->filterByEnsUserId(array('min' => 12)); // WHERE ens_user_id > 12
	 * </code>
	 *
	 * @param     mixed $ensUserId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailNotificationSettingQuery The current query, for fluid interface
	 */
	public function filterByEnsUserId($ensUserId = null, $comparison = null)
	{
		if (is_array($ensUserId)) {
			$useMinMax = false;
			if (isset($ensUserId['min'])) {
				$this->addUsingAlias(EmailNotificationSettingPeer::ENS_USER_ID, $ensUserId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ensUserId['max'])) {
				$this->addUsingAlias(EmailNotificationSettingPeer::ENS_USER_ID, $ensUserId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EmailNotificationSettingPeer::ENS_USER_ID, $ensUserId, $comparison);
	}

	/**
	 * Filter the query on the ens_ent_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEnsEntId(1234); // WHERE ens_ent_id = 1234
	 * $query->filterByEnsEntId(array(12, 34)); // WHERE ens_ent_id IN (12, 34)
	 * $query->filterByEnsEntId(array('min' => 12)); // WHERE ens_ent_id > 12
	 * </code>
	 *
	 * @param     mixed $ensEntId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailNotificationSettingQuery The current query, for fluid interface
	 */
	public function filterByEnsEntId($ensEntId = null, $comparison = null)
	{
		if (is_array($ensEntId)) {
			$useMinMax = false;
			if (isset($ensEntId['min'])) {
				$this->addUsingAlias(EmailNotificationSettingPeer::ENS_ENT_ID, $ensEntId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ensEntId['max'])) {
				$this->addUsingAlias(EmailNotificationSettingPeer::ENS_ENT_ID, $ensEntId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EmailNotificationSettingPeer::ENS_ENT_ID, $ensEntId, $comparison);
	}

	/**
	 * Filter the query on the ens_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEnsStatus(1234); // WHERE ens_status = 1234
	 * $query->filterByEnsStatus(array(12, 34)); // WHERE ens_status IN (12, 34)
	 * $query->filterByEnsStatus(array('min' => 12)); // WHERE ens_status > 12
	 * </code>
	 *
	 * @param     mixed $ensStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    EmailNotificationSettingQuery The current query, for fluid interface
	 */
	public function filterByEnsStatus($ensStatus = null, $comparison = null)
	{
		if (is_array($ensStatus)) {
			$useMinMax = false;
			if (isset($ensStatus['min'])) {
				$this->addUsingAlias(EmailNotificationSettingPeer::ENS_STATUS, $ensStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($ensStatus['max'])) {
				$this->addUsingAlias(EmailNotificationSettingPeer::ENS_STATUS, $ensStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(EmailNotificationSettingPeer::ENS_STATUS, $ensStatus, $comparison);
	}

	/**
	 * Exclude object from result
	 *
	 * @param     EmailNotificationSetting $emailNotificationSetting Object to remove from the list of results
	 *
	 * @return    EmailNotificationSettingQuery The current query, for fluid interface
	 */
	public function prune($emailNotificationSetting = null)
	{
		if ($emailNotificationSetting) {
			$this->addUsingAlias(EmailNotificationSettingPeer::ENS_ID, $emailNotificationSetting->getEnsId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseEmailNotificationSettingQuery